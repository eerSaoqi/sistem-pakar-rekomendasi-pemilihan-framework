<?php

namespace App\Services;

use App\Models\Konsultasi;
use App\Models\JawabanKonsultasi;
use App\Models\HasilKonsultasi;
use App\Models\Framework;
use App\Models\KnowledgeBase;
use App\Models\JenisProyek;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use Illuminate\Support\Facades\DB;

class CertaintyFactorService
{
    /**
     * Calculate Certainty Factor and save consultation results.
     *
     * @param int $jenisProyekId
     * @param string $nama
     * @param string $email
     * @param array $answers Format: [pertanyaan_id => [opsi_jawaban_id => X, cf_user => Y]]
     * @return Konsultasi
     */
    public function calculate(int $jenisProyekId, string $nama, string $email, array $answers): Konsultasi
    {
        return DB::transaction(function () use ($jenisProyekId, $nama, $email, $answers) {
            // 1. Create Konsultasi record
            $konsultasi = Konsultasi::create([
                'nama' => $nama,
                'email' => $email,
                'tanggal' => now(),
                'jenis_proyek_id' => $jenisProyekId,
            ]);

            // 2. Save User Answers
            foreach ($answers as $pertanyaanId => $ans) {
                if (empty($ans['opsi_jawaban_id'])) {
                    continue;
                }

                JawabanKonsultasi::create([
                    'konsultasi_id' => $konsultasi->id,
                    'pertanyaan_id' => $pertanyaanId,
                    'opsi_jawaban_id' => $ans['opsi_jawaban_id'],
                    'cf_user' => floatval($ans['cf_user'] ?? 0),
                ]);
            }

            // 3. Retrieve all Frameworks in the relevant categories for this jenis proyek
            $jenisProyek = JenisProyek::with('kategoriFrameworks')->find($jenisProyekId);
            $kategoriIds = $jenisProyek->kategoriFrameworks->pluck('id')->toArray();
            $frameworks = Framework::whereIn('kategori_framework_id', $kategoriIds)->get();

            $frameworkScores = [];

            // 3b. Determine user's chosen language (P01) for hard language filtering
            $userSelectedLanguage = null;
            $p1Question = Pertanyaan::where('kode', 'P01')->first();
            if ($p1Question && isset($answers[$p1Question->id])) {
                $langOpsiId = $answers[$p1Question->id]['opsi_jawaban_id'] ?? null;
                if ($langOpsiId) {
                    $langOpsi = OpsiJawaban::find($langOpsiId);
                    if ($langOpsi) {
                        $userSelectedLanguage = $langOpsi->jawaban; // e.g. 'PHP', 'Python', etc.
                    }
                }
            }

            // 4. Calculate CF for each framework using Knowledge Base
            foreach ($frameworks as $fw) {
                // HARD FILTER: If user selected a language, skip frameworks that don't match
                if ($userSelectedLanguage !== null && $fw->bahasa !== $userSelectedLanguage) {
                    $frameworkScores[$fw->id] = 0.0; // Set to 0, not recommended
                    continue;
                }
                $kbEntries = KnowledgeBase::where('framework_id', $fw->id)->get();
                $matchedCFs = [];

                foreach ($kbEntries as $kb) {
                    // Check if user answered this question
                    if (isset($answers[$kb->pertanyaan_id])) {
                        $userAns = $answers[$kb->pertanyaan_id];

                        // If user selected the same option as the knowledge base entry
                        if (intval($userAns['opsi_jawaban_id']) === intval($kb->opsi_jawaban_id)) {
                            $cfUser = floatval($userAns['cf_user'] ?? 0);
                            $cfPakar = floatval($kb->cf_pakar);

                            // CF(H,E) = CF(User) * CF(Pakar)
                            $cfValue = $cfUser * $cfPakar;
                            if ($cfValue != 0) {
                                $matchedCFs[] = $cfValue;
                            }
                        }
                    }
                }

                // Combine CFs using sequential combination formula
                $combinedCF = 0.0;
                if (!empty($matchedCFs)) {
                    $combinedCF = $matchedCFs[0];
                    for ($i = 1; $i < count($matchedCFs); $i++) {
                        $cfNext = $matchedCFs[$i];
                        if ($combinedCF >= 0 && $cfNext >= 0) {
                            $combinedCF = $combinedCF + $cfNext * (1.0 - $combinedCF);
                        } elseif ($combinedCF < 0 && $cfNext < 0) {
                            $combinedCF = $combinedCF + $cfNext * (1.0 + $combinedCF);
                        } else {
                            $denom = 1.0 - min(abs($combinedCF), abs($cfNext));
                            if (abs($denom) < 0.0001) {
                                if ($combinedCF == 1.0 || $cfNext == 1.0) {
                                    $combinedCF = 1.0;
                                } elseif ($combinedCF == -1.0 || $cfNext == -1.0) {
                                    $combinedCF = -1.0;
                                } else {
                                    $combinedCF = 0.0;
                                }
                            } else {
                                $combinedCF = ($combinedCF + $cfNext) / $denom;
                            }
                        }
                    }
                }

                $frameworkScores[$fw->id] = $combinedCF;
            }

            // 5. Sort by CF score descending
            arsort($frameworkScores);

            // 6. Save results with rankings
            $ranking = 1;
            foreach ($frameworkScores as $fwId => $score) {
                HasilKonsultasi::create([
                    'konsultasi_id' => $konsultasi->id,
                    'framework_id' => $fwId,
                    'nilai_cf' => $score,
                    'persentase' => max(0, round($score * 100, 2)),
                    'ranking' => $ranking++,
                ]);
            }

            return $konsultasi;
        });
    }

    /**
     * Reconstruct detailed CF calculation steps for a given consultation.
     *
     * Returns an array keyed by framework_id, each containing:
     * - framework: Framework model
     * - steps: array of individual CF(H,E) calculations
     * - combine_steps: array of iterative combination steps
     * - combined_cf: final combined CF value
     * - persentase: percentage
     *
     * @param Konsultasi $konsultasi
     * @return array
     */
    public function getCalculationDetails(Konsultasi $konsultasi): array
    {
        $konsultasi->load(['jawabanKonsultasis.pertanyaan', 'jawabanKonsultasis.opsiJawaban', 'jenisProyek.kategoriFrameworks']);

        $kategoriIds = $konsultasi->jenisProyek->kategoriFrameworks->pluck('id')->toArray();
        $frameworks = Framework::whereIn('kategori_framework_id', $kategoriIds)->get();

        // Build lookup of user answers: pertanyaan_id => JawabanKonsultasi
        $userAnswers = [];
        foreach ($konsultasi->jawabanKonsultasis as $jawaban) {
            $userAnswers[$jawaban->pertanyaan_id] = $jawaban;
        }

        // Determine user's chosen language (P01) for hard language filtering
        $userSelectedLanguage = null;
        $p1Question = Pertanyaan::where('kode', 'P01')->first();
        if ($p1Question && isset($userAnswers[$p1Question->id])) {
            $userSelectedLanguage = $userAnswers[$p1Question->id]->opsiJawaban->jawaban ?? null;
        }

        $details = [];

        foreach ($frameworks as $fw) {
            // HARD FILTER: skip frameworks whose language doesn't match user's choice
            if ($userSelectedLanguage !== null && $fw->bahasa !== $userSelectedLanguage) {
                $details[$fw->id] = [
                    'framework' => $fw,
                    'steps' => [],
                    'combine_steps' => [],
                    'combined_cf' => 0.0,
                    'persentase' => 0.0,
                    'filtered_by_language' => true,
                ];
                continue;
            }
            $kbEntries = KnowledgeBase::with(['pertanyaan', 'opsiJawaban'])
                ->where('framework_id', $fw->id)
                ->get();

            $steps = [];
            $matchedCFs = [];

            foreach ($kbEntries as $kb) {
                if (isset($userAnswers[$kb->pertanyaan_id])) {
                    $jawaban = $userAnswers[$kb->pertanyaan_id];

                    if (intval($jawaban->opsi_jawaban_id) === intval($kb->opsi_jawaban_id)) {
                        $cfUser = floatval($jawaban->cf_user);
                        $cfPakar = floatval($kb->cf_pakar);
                        $cfValue = $cfUser * $cfPakar;

                        $steps[] = [
                            'pertanyaan_kode' => $kb->pertanyaan->kode,
                            'pertanyaan_text' => $kb->pertanyaan->pertanyaan,
                            'opsi_jawaban' => $kb->opsiJawaban->jawaban,
                            'cf_user' => $cfUser,
                            'cf_pakar' => $cfPakar,
                            'cf_value' => $cfValue,
                        ];

                        if ($cfValue != 0) {
                            $matchedCFs[] = $cfValue;
                        }
                    }
                }
            }

            // Reconstruct combine steps
            $combineSteps = [];
            $combinedCF = 0.0;

            if (!empty($matchedCFs)) {
                $combinedCF = $matchedCFs[0];
                $combineSteps[] = [
                    'step' => 1,
                    'cf_old' => null,
                    'cf_next' => $matchedCFs[0],
                    'cf_combined' => $matchedCFs[0],
                    'formula' => 'CF awal = ' . number_format($matchedCFs[0], 4),
                ];

                for ($i = 1; $i < count($matchedCFs); $i++) {
                    $cfOld = $combinedCF;
                    $cfNext = $matchedCFs[$i];

                    if ($combinedCF >= 0 && $cfNext >= 0) {
                        $combinedCF = $combinedCF + $cfNext * (1.0 - $combinedCF);
                        $formula = number_format($cfOld, 4) . ' + ' . number_format($cfNext, 4) . ' × (1 - ' . number_format($cfOld, 4) . ')';
                    } elseif ($combinedCF < 0 && $cfNext < 0) {
                        $combinedCF = $combinedCF + $cfNext * (1.0 + $combinedCF);
                        $formula = number_format($cfOld, 4) . ' + ' . number_format($cfNext, 4) . ' × (1 + ' . number_format($cfOld, 4) . ')';
                    } else {
                        $denom = 1.0 - min(abs($combinedCF), abs($cfNext));
                        if (abs($denom) < 0.0001) {
                            if ($combinedCF == 1.0 || $cfNext == 1.0) {
                                $combinedCF = 1.0;
                            } elseif ($combinedCF == -1.0 || $cfNext == -1.0) {
                                $combinedCF = -1.0;
                            } else {
                                $combinedCF = 0.0;
                            }
                        } else {
                            $combinedCF = ($combinedCF + $cfNext) / $denom;
                        }
                        $formula = '(' . number_format($cfOld, 4) . ' + ' . number_format($cfNext, 4) . ') / (1 - min(|' . number_format($cfOld, 4) . '|, |' . number_format($cfNext, 4) . '|))';
                    }

                    $combineSteps[] = [
                        'step' => $i + 1,
                        'cf_old' => $cfOld,
                        'cf_next' => $cfNext,
                        'cf_combined' => $combinedCF,
                        'formula' => $formula,
                    ];
                }
            }

            $details[$fw->id] = [
                'framework' => $fw,
                'steps' => $steps,
                'combine_steps' => $combineSteps,
                'combined_cf' => $combinedCF,
                'persentase' => max(0, round($combinedCF * 100, 2)),
            ];
        }

        // Sort by combined_cf descending
        uasort($details, fn($a, $b) => $b['combined_cf'] <=> $a['combined_cf']);

        return $details;
    }
}
