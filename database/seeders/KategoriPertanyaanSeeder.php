<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;
use App\Models\KategoriFramework;

class KategoriPertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        // Pemetaan: Pertanyaan -> Kategori Framework yang relevan berdasarkan PDF (tabel checklist)
        $mapping = [
            'P01' => ['KT01', 'KT02', 'KT03', 'KT04'], // Bahasa - semua
            'P02' => ['KT01', 'KT02', 'KT03', 'KT04'], // Pengalaman - semua
            'P03' => ['KT01', 'KT02', 'KT03', 'KT04'], // Jumlah tim - semua
            'P04' => ['KT01', 'KT02', 'KT03', 'KT04'], // Target penyelesaian - semua
            'P05' => ['KT01', 'KT04'],                 // Pengguna - Backend & Full Stack
            'P06' => ['KT01', 'KT02', 'KT03', 'KT04'], // Platform - semua
            'P07' => ['KT01', 'KT02', 'KT04'],         // Dikembangkan lagi - Backend, Frontend, Full Stack
            'P08' => ['KT01', 'KT04'],                 // REST API - Backend, Full Stack
            'P09' => ['KT01', 'KT04'],                 // Autentikasi - Backend, Full Stack
            'P10' => ['KT01', 'KT02', 'KT04'],         // WebSocket - Backend, Frontend, Full Stack
            'P11' => ['KT02', 'KT04'],                 // SEO - Frontend, Full Stack
            'P12' => ['KT02', 'KT04'],                 // SSR - Frontend, Full Stack
            'P13' => ['KT03'],                         // Android & iOS - Mobile
            'P14' => ['KT01', 'KT02', 'KT03', 'KT04'], // Performa - semua
            'P15' => ['KT01', 'KT04'],                 // Keamanan - Backend, Full Stack
            'P16' => ['KT01', 'KT02', 'KT04'],         // Skalabilitas - Backend, Frontend, Full Stack
            'P17' => ['KT01', 'KT02', 'KT03', 'KT04'], // Dokumentasi - semua
            'P18' => ['KT01', 'KT02', 'KT03', 'KT04'], // Komunitas - semua
            'P19' => ['KT01', 'KT02', 'KT04'],         // Maintenance - Backend, Frontend, Full Stack
            'P20' => ['KT01', 'KT02', 'KT03', 'KT04'], // Mudah dipelajari - semua
        ];

        foreach ($mapping as $pKode => $katKodes) {
            $pertanyaan = Pertanyaan::where('kode', $pKode)->first();
            if (!$pertanyaan) continue;

            $katIds = KategoriFramework::whereIn('kode', $katKodes)->pluck('id')->toArray();
            $pertanyaan->kategoriFrameworks()->sync($katIds);
        }
    }
}
