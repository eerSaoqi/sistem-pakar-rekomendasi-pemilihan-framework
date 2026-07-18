<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;

class OpsiJawabanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // JP01: Jenis Proyek
            'JP01' => [
                ['kode' => 'OJP01', 'jawaban' => 'Website Company Profile', 'urutan' => 1],
                ['kode' => 'OJP02', 'jawaban' => 'Dashboard', 'urutan' => 2],
                ['kode' => 'OJP03', 'jawaban' => 'Sistem Informasi', 'urutan' => 3],
                ['kode' => 'OJP04', 'jawaban' => 'REST API', 'urutan' => 4],
                ['kode' => 'OJP05', 'jawaban' => 'E-Commerce', 'urutan' => 5],
                ['kode' => 'OJP06', 'jawaban' => 'Mobile App', 'urutan' => 6],
                ['kode' => 'OJP07', 'jawaban' => 'AI / Machine Learning', 'urutan' => 7],
                ['kode' => 'OJP08', 'jawaban' => 'Enterprise Application', 'urutan' => 8],
            ],
            // P01: Bahasa pemrograman
            'P01' => [
                ['kode' => 'OP011', 'jawaban' => 'PHP', 'urutan' => 1],
                ['kode' => 'OP012', 'jawaban' => 'JavaScript', 'urutan' => 2],
                ['kode' => 'OP013', 'jawaban' => 'TypeScript', 'urutan' => 3],
                ['kode' => 'OP014', 'jawaban' => 'Python', 'urutan' => 4],
                ['kode' => 'OP015', 'jawaban' => 'Java', 'urutan' => 5],
                ['kode' => 'OP016', 'jawaban' => 'C#', 'urutan' => 6],
                ['kode' => 'OP017', 'jawaban' => 'Dart', 'urutan' => 7],
            ],
            // P02: Tingkat pengalaman
            'P02' => [
                ['kode' => 'OP021', 'jawaban' => 'Pemula', 'urutan' => 1],
                ['kode' => 'OP022', 'jawaban' => 'Menengah', 'urutan' => 2],
                ['kode' => 'OP023', 'jawaban' => 'Mahir', 'urutan' => 3],
            ],
            // P03: Jumlah anggota tim
            'P03' => [
                ['kode' => 'OP031', 'jawaban' => 'Sendiri', 'urutan' => 1],
                ['kode' => 'OP032', 'jawaban' => '2–5 Orang', 'urutan' => 2],
                ['kode' => 'OP033', 'jawaban' => '6–10 Orang', 'urutan' => 3],
                ['kode' => 'OP034', 'jawaban' => '>10 Orang', 'urutan' => 4],
            ],
            // P04: Target penyelesaian
            'P04' => [
                ['kode' => 'OP041', 'jawaban' => 'Sangat Cepat', 'urutan' => 1],
                ['kode' => 'OP042', 'jawaban' => 'Normal', 'urutan' => 2],
                ['kode' => 'OP043', 'jawaban' => 'Fleksibel', 'urutan' => 3],
            ],
            // P05: Jumlah pengguna
            'P05' => [
                ['kode' => 'OP051', 'jawaban' => '<100', 'urutan' => 1],
                ['kode' => 'OP052', 'jawaban' => '100–1.000', 'urutan' => 2],
                ['kode' => 'OP053', 'jawaban' => '1.000–10.000', 'urutan' => 3],
                ['kode' => 'OP054', 'jawaban' => '>10.000', 'urutan' => 4],
            ],
            // P06: Platform utama
            'P06' => [
                ['kode' => 'OP061', 'jawaban' => 'Website', 'urutan' => 1],
                ['kode' => 'OP062', 'jawaban' => 'Mobile', 'urutan' => 2],
                ['kode' => 'OP063', 'jawaban' => 'Desktop', 'urutan' => 3],
                ['kode' => 'OP064', 'jawaban' => 'Multi Platform', 'urutan' => 4],
            ],
            // P07: Dikembangkan di masa depan
            'P07' => [
                ['kode' => 'OP071', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP072', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P08: REST API
            'P08' => [
                ['kode' => 'OP081', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP082', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P09: Autentikasi bawaan
            'P09' => [
                ['kode' => 'OP091', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP092', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P10: WebSocket
            'P10' => [
                ['kode' => 'OP101', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP102', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P11: SEO prioritas
            'P11' => [
                ['kode' => 'OP111', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP112', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P12: SSR
            'P12' => [
                ['kode' => 'OP121', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP122', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P13: Android & iOS
            'P13' => [
                ['kode' => 'OP131', 'jawaban' => 'Ya', 'urutan' => 1],
                ['kode' => 'OP132', 'jawaban' => 'Tidak', 'urutan' => 2],
            ],
            // P14: Performa (Prioritas)
            'P14' => [
                ['kode' => 'OP141', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP142', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP143', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P15: Keamanan (Prioritas)
            'P15' => [
                ['kode' => 'OP151', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP152', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP153', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P16: Skalabilitas (Prioritas)
            'P16' => [
                ['kode' => 'OP161', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP162', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP163', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P17: Dokumentasi (Prioritas)
            'P17' => [
                ['kode' => 'OP171', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP172', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP173', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P18: Komunitas (Prioritas)
            'P18' => [
                ['kode' => 'OP181', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP182', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP183', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P19: Maintenance (Prioritas)
            'P19' => [
                ['kode' => 'OP191', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP192', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP193', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
            // P20: Mudah dipelajari (Prioritas)
            'P20' => [
                ['kode' => 'OP201', 'jawaban' => 'Rendah', 'urutan' => 1],
                ['kode' => 'OP202', 'jawaban' => 'Sedang', 'urutan' => 2],
                ['kode' => 'OP203', 'jawaban' => 'Tinggi', 'urutan' => 3],
            ],
        ];

        foreach ($data as $pKode => $options) {
            $pertanyaan = Pertanyaan::where('kode', $pKode)->first();
            if (!$pertanyaan) continue;

            foreach ($options as $opt) {
                OpsiJawaban::updateOrCreate(
                    ['kode' => $opt['kode']],
                    array_merge($opt, ['pertanyaan_id' => $pertanyaan->id])
                );
            }
        }
    }
}
