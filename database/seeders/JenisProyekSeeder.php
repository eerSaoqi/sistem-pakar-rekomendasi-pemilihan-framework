<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisProyek;

class JenisProyekSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'JP01', 'nama' => 'Website Company Profile'],
            ['kode' => 'JP02', 'nama' => 'Dashboard'],
            ['kode' => 'JP03', 'nama' => 'Sistem Informasi'],
            ['kode' => 'JP04', 'nama' => 'REST API'],
            ['kode' => 'JP05', 'nama' => 'E-Commerce'],
            ['kode' => 'JP06', 'nama' => 'Mobile App'],
            ['kode' => 'JP07', 'nama' => 'AI / Machine Learning'],
            ['kode' => 'JP08', 'nama' => 'Enterprise Application'],
        ];

        foreach ($data as $item) {
            JenisProyek::updateOrCreate(['kode' => $item['kode']], $item);
        }
    }
}
