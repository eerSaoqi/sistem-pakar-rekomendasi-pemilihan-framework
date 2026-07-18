<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisProyek;
use App\Models\KategoriFramework;

class JenisProyekKategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Pemetaan: Jenis Proyek -> Kategori yang Aktif
        $mapping = [
            'JP01' => ['KT01', 'KT02', 'KT04'],             // Website Company Profile -> Backend + Frontend + Full Stack
            'JP02' => ['KT01', 'KT02', 'KT04'],     // Dashboard -> Backend + Frontend + Full Stack
            'JP03' => ['KT01', 'KT02', 'KT04'],     // Sistem Informasi -> Backend + Frontend + Full Stack
            'JP04' => ['KT01'],                       // REST API -> Backend
            'JP05' => ['KT01', 'KT02', 'KT04'],     // E-Commerce -> Backend + Frontend + Full Stack
            'JP06' => ['KT03'],                       // Mobile App -> Mobile
            'JP07' => ['KT01'],                       // AI / Machine Learning -> Backend
            'JP08' => ['KT01', 'KT04'],              // Enterprise Application -> Backend + Full Stack
        ];

        foreach ($mapping as $jpKode => $katKodes) {
            $jp = JenisProyek::where('kode', $jpKode)->first();
            if (!$jp) continue;

            $katIds = KategoriFramework::whereIn('kode', $katKodes)->pluck('id')->toArray();
            $jp->kategoriFrameworks()->syncWithoutDetaching($katIds);
        }
    }
}
