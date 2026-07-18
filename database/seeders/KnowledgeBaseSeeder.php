<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Framework;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use App\Models\KnowledgeBase;

class KnowledgeBaseSeeder extends Seeder
{
    public function run(): void
    {
        // Format: [framework_kode, pertanyaan_kode, opsi_jawaban_kode, cf_pakar]
        $entries = [
            // ===================== FW001: LARAVEL (15 entries) =====================
            ['FW001', 'P01', 'OP011', 1.00],   // Bahasa: PHP (Fakta Mutlak)
            ['FW001', 'P02', 'OP021', 0.90],   // Pengalaman: Pemula
            ['FW001', 'P02', 'OP022', 0.95],   // Pengalaman: Menengah
            ['FW001', 'JP01', 'OJP03', 0.95],  // Jenis Proyek: Sistem Informasi
            ['FW001', 'JP01', 'OJP02', 0.95],  // Jenis Proyek: Dashboard
            ['FW001', 'JP01', 'OJP05', 0.90],  // Jenis Proyek: E-Commerce
            ['FW001', 'P04', 'OP041', 0.85],   // Target penyelesaian: Sangat Cepat
            ['FW001', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW001', 'P09', 'OP091', 0.95],   // Autentikasi: Ya
            ['FW001', 'P10', 'OP101', 0.80],   // WebSocket: Ya
            ['FW001', 'P15', 'OP153', 0.95],   // Keamanan: Tinggi
            ['FW001', 'P17', 'OP173', 0.95],   // Dokumentasi: Tinggi
            ['FW001', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi
            ['FW001', 'P19', 'OP193', 0.90],   // Maintenance: Tinggi
            ['FW001', 'P20', 'OP203', 0.90],   // Mudah Dipelajari: Tinggi

            // ===================== FW002: CODEIGNITER 4 (10 entries) =====================
            ['FW002', 'P01', 'OP011', 1.00],   // Bahasa: PHP (Fakta Mutlak)
            ['FW002', 'P02', 'OP021', 0.95],   // Pengalaman: Pemula
            ['FW002', 'JP01', 'OJP02', 0.90],  // Jenis Proyek: Dashboard
            ['FW002', 'JP01', 'OJP03', 0.95],  // Jenis Proyek: Sistem Informasi
            ['FW002', 'P08', 'OP081', 0.80],   // REST API: Ya
            ['FW002', 'P04', 'OP041', 0.90],   // Target penyelesaian: Sangat Cepat
            ['FW002', 'P14', 'OP143', 0.90],   // Performa: Tinggi
            ['FW002', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW002', 'P18', 'OP183', 0.85],   // Komunitas: Tinggi
            ['FW002', 'P20', 'OP203', 0.95],   // Mudah Dipelajari: Tinggi

            // ===================== FW003: EXPRESS.JS (9 entries) =====================
            ['FW003', 'P01', 'OP012', 1.00],   // Bahasa: JavaScript (Fakta Mutlak)
            ['FW003', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW003', 'P10', 'OP101', 0.95],   // WebSocket: Ya
            ['FW003', 'P14', 'OP143', 0.90],   // Performa: Tinggi
            ['FW003', 'P16', 'OP163', 0.90],   // Skalabilitas: Tinggi
            ['FW003', 'JP01', 'OJP04', 0.95],  // Jenis Proyek: REST API
            ['FW003', 'P02', 'OP022', 0.90],   // Pengalaman: Menengah
            ['FW003', 'P17', 'OP173', 0.85],   // Dokumentasi: Tinggi
            ['FW003', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi

            // ===================== FW004: NESTJS (8 entries) =====================
            ['FW004', 'P01', 'OP013', 1.00],   // Bahasa: TypeScript (Fakta Mutlak)
            ['FW004', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW004', 'JP01', 'OJP08', 0.95],  // Jenis Proyek: Enterprise Application
            ['FW004', 'P02', 'OP023', 0.95],   // Pengalaman: Mahir
            ['FW004', 'P16', 'OP163', 0.95],   // Skalabilitas: Tinggi
            ['FW004', 'P15', 'OP153', 0.95],   // Keamanan: Tinggi
            ['FW004', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW004', 'P18', 'OP183', 0.85],   // Komunitas: Tinggi

            // ===================== FW005: DJANGO (8 entries) =====================
            ['FW005', 'P01', 'OP014', 1.00],   // Bahasa: Python (Fakta Mutlak)
            ['FW005', 'P08', 'OP081', 0.90],   // REST API: Ya
            ['FW005', 'P09', 'OP091', 0.95],   // Autentikasi: Ya
            ['FW005', 'JP01', 'OJP07', 0.95],  // Jenis Proyek: AI / Machine Learning
            ['FW005', 'P15', 'OP153', 0.95],   // Keamanan: Tinggi
            ['FW005', 'P16', 'OP163', 0.95],   // Skalabilitas: Tinggi
            ['FW005', 'P17', 'OP173', 0.95],   // Dokumentasi: Tinggi
            ['FW005', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi

            // ===================== FW006: FASTAPI (7 entries) =====================
            ['FW006', 'P01', 'OP014', 1.00],   // Bahasa: Python (Fakta Mutlak)
            ['FW006', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW006', 'JP01', 'OJP07', 0.95],  // Jenis Proyek: AI / Machine Learning
            ['FW006', 'P14', 'OP143', 0.95],   // Performa: Tinggi
            ['FW006', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW006', 'P16', 'OP163', 0.90],   // Skalabilitas: Tinggi
            ['FW006', 'P02', 'OP022', 0.85],   // Pengalaman: Menengah

            // ===================== FW007: SPRING BOOT (8 entries) =====================
            ['FW007', 'P01', 'OP015', 1.00],   // Bahasa: Java (Fakta Mutlak)
            ['FW007', 'JP01', 'OJP08', 0.95],  // Jenis Proyek: Enterprise Application
            ['FW007', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW007', 'P15', 'OP153', 0.95],   // Keamanan: Tinggi
            ['FW007', 'P16', 'OP163', 0.95],   // Skalabilitas: Tinggi
            ['FW007', 'P02', 'OP023', 0.95],   // Pengalaman: Mahir
            ['FW007', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW007', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi

            // ===================== FW008: ASP.NET CORE (8 entries) =====================
            ['FW008', 'P01', 'OP016', 1.00],   // Bahasa: C# (Fakta Mutlak)
            ['FW008', 'JP01', 'OJP08', 0.95],  // Jenis Proyek: Enterprise Application
            ['FW008', 'P09', 'OP091', 0.95],   // Autentikasi: Ya
            ['FW008', 'P08', 'OP081', 0.95],   // REST API: Ya
            ['FW008', 'P15', 'OP153', 0.95],   // Keamanan: Tinggi
            ['FW008', 'P16', 'OP163', 0.95],   // Skalabilitas: Tinggi
            ['FW008', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW008', 'P14', 'OP143', 0.95],   // Performa: Tinggi

            // ===================== FW009: REACT (8 entries) =====================
            ['FW009', 'P01', 'OP012', 1.00],   // Bahasa: JavaScript (Fakta Mutlak)
            ['FW009', 'JP01', 'OJP01', 0.90],  // Jenis Proyek: Website
            ['FW009', 'JP01', 'OJP02', 0.95],  // Jenis Proyek: Dashboard
            ['FW009', 'P12', 'OP122', 0.95],   // SSR: Tidak (SPA)
            ['FW009', 'P14', 'OP143', 0.95],   // Performa: Tinggi
            ['FW009', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW009', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi
            ['FW009', 'P02', 'OP022', 0.85],   // Pengalaman: Menengah

            // ===================== FW010: VUE.JS (8 entries) =====================
            ['FW010', 'P01', 'OP012', 1.00],   // Bahasa: JavaScript (Fakta Mutlak)
            ['FW010', 'JP01', 'OJP01', 0.95],  // Jenis Proyek: Website
            ['FW010', 'JP01', 'OJP02', 0.95],  // Jenis Proyek: Dashboard
            ['FW010', 'P12', 'OP122', 0.95],   // SSR: Tidak (SPA)
            ['FW010', 'P20', 'OP203', 0.95],   // Mudah Dipelajari: Tinggi
            ['FW010', 'P17', 'OP173', 0.95],   // Dokumentasi: Tinggi
            ['FW010', 'P18', 'OP183', 0.90],   // Komunitas: Tinggi
            ['FW010', 'P14', 'OP143', 0.90],   // Performa: Tinggi

            // ===================== FW011: FLUTTER (7 entries) =====================
            ['FW011', 'P01', 'OP017', 1.00],   // Bahasa: Dart (Fakta Mutlak)
            ['FW011', 'JP01', 'OJP06', 0.95],  // Jenis Proyek: Mobile App
            ['FW011', 'P13', 'OP131', 0.95],   // Android & iOS: Ya
            ['FW011', 'P14', 'OP143', 0.95],   // Performa: Tinggi
            ['FW011', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
            ['FW011', 'P18', 'OP183', 0.95],   // Komunitas: Tinggi
            ['FW011', 'P20', 'OP203', 0.90],   // Mudah Dipelajari: Tinggi

            // ===================== FW012: NEXT.JS (9 entries) =====================
            ['FW012', 'P01', 'OP012', 1.00],   // Bahasa: JavaScript (Fakta Mutlak)
            ['FW012', 'JP01', 'OJP01', 0.95],  // Jenis Proyek: Website
            ['FW012', 'JP01', 'OJP05', 0.90],  // Jenis Proyek: E-Commerce
            ['FW012', 'P11', 'OP111', 0.95],   // SEO: Ya
            ['FW012', 'P12', 'OP121', 0.95],   // SSR: Ya
            ['FW012', 'P08', 'OP081', 0.80],   // REST API: Ya
            ['FW012', 'P16', 'OP163', 0.95],   // Skalabilitas: Tinggi
            ['FW012', 'P14', 'OP143', 0.95],   // Performa: Tinggi
            ['FW012', 'P17', 'OP173', 0.90],   // Dokumentasi: Tinggi
        ];

        foreach ($entries as $entry) {
            $fw = Framework::where('kode', $entry[0])->first();
            $pertanyaan = Pertanyaan::where('kode', $entry[1])->first();
            $opsi = OpsiJawaban::where('kode', $entry[2])->first();

            if (!$fw || !$pertanyaan || !$opsi) {
                continue;
            }

            KnowledgeBase::updateOrCreate(
                [
                    'framework_id' => $fw->id,
                    'pertanyaan_id' => $pertanyaan->id,
                    'opsi_jawaban_id' => $opsi->id,
                ],
                ['cf_pakar' => $entry[3]]
            );
        }

        // ===================== DYNAMIC P01: BAHASA PEMROGRAMAN PENALTIES =====================
        $langOptionMap = [
            'PHP' => 'OP011',
            'JavaScript' => 'OP012',
            'TypeScript' => 'OP013',
            'Python' => 'OP014',
            'Java' => 'OP015',
            'C#' => 'OP016',
            'Dart' => 'OP017',
        ];

        $p1 = Pertanyaan::where('kode', 'P01')->first();
        if ($p1) {
            $frameworks = Framework::all();
            foreach ($frameworks as $fw) {
                $fwLang = $fw->bahasa;
                foreach ($langOptionMap as $lang => $optKode) {
                    $opsi = OpsiJawaban::where('kode', $optKode)->first();
                    if ($opsi) {
                        // Jika bahasa pemrograman cocok, berikan rekomendasi tinggi (0.95), jika tidak cocok, penalti keras (-0.95)
                        $cfVal = ($lang === $fwLang) ? 0.95 : -0.95;
                        KnowledgeBase::updateOrCreate(
                            [
                                'framework_id' => $fw->id,
                                'pertanyaan_id' => $p1->id,
                                'opsi_jawaban_id' => $opsi->id,
                            ],
                            ['cf_pakar' => $cfVal]
                        );
                    }
                }
            }
        }

        // ===================== DYNAMIC P02: TINGKAT PENGALAMAN SUITABILITY =====================
        $p2 = Pertanyaan::where('kode', 'P02')->first();
        if ($p2) {
            // Pemetaan CF: OP021 (Pemula), OP022 (Menengah), OP023 (Mahir)
            $expMapping = [
                'FW001' => ['OP021' => 0.90, 'OP022' => 0.95, 'OP023' => 0.80],  // Laravel (Sangat oke untuk pemula/menengah)
                'FW002' => ['OP021' => 0.95, 'OP022' => 0.80, 'OP023' => 0.60],  // CI4 (Sangat mudah bagi pemula)
                'FW003' => ['OP021' => -0.50, 'OP022' => 0.90, 'OP023' => 0.95], // Express (Kurang cocok untuk pemula, butuh basic async JS)
                'FW004' => ['OP021' => -0.85, 'OP022' => 0.70, 'OP023' => 0.95], // NestJS (Terlalu rumit dengan OOP/DI tingkat lanjut)
                'FW005' => ['OP021' => -0.25, 'OP022' => 0.85, 'OP023' => 0.95], // Django (Sedikit rumit untuk pemula)
                'FW006' => ['OP021' => -0.30, 'OP022' => 0.85, 'OP023' => 0.95], // FastAPI (Sedikit rumit untuk pemula)
                'FW007' => ['OP021' => -0.85, 'OP022' => 0.60, 'OP023' => 0.95], // Spring Boot (Sangat berat kurva belajarnya untuk pemula)
                'FW008' => ['OP021' => -0.85, 'OP022' => 0.60, 'OP023' => 0.95], // ASP.NET Core (Sangat berat kurva belajarnya untuk pemula)
                'FW009' => ['OP021' => -0.30, 'OP022' => 0.85, 'OP023' => 0.95], // React (Butuh pemahaman JavaScript modern ES6+)
                'FW010' => ['OP021' => 0.90, 'OP022' => 0.95, 'OP023' => 0.80],  // Vue.js (Sangat ramah bagi pemula)
                'FW011' => ['OP021' => -0.20, 'OP022' => 0.90, 'OP023' => 0.95], // Flutter (Butuh pemahaman OOP Dart)
                'FW012' => ['OP021' => -0.40, 'OP022' => 0.85, 'OP023' => 0.95], // Next.js (Butuh pemahaman React tingkat lanjut)
            ];

            foreach ($expMapping as $fwKode => $opts) {
                $fw = Framework::where('kode', $fwKode)->first();
                if ($fw) {
                    foreach ($opts as $optKode => $cfVal) {
                        $opsi = OpsiJawaban::where('kode', $optKode)->first();
                        if ($opsi) {
                            KnowledgeBase::updateOrCreate(
                                [
                                    'framework_id' => $fw->id,
                                    'pertanyaan_id' => $p2->id,
                                    'opsi_jawaban_id' => $opsi->id,
                                ],
                                ['cf_pakar' => $cfVal]
                            );
                        }
                    }
                }
            }
        }
    }
}
