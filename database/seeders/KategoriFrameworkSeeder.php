<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriFramework;

class KategoriFrameworkSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['kode' => 'KT01', 'nama' => 'Backend', 'deskripsi' => 'Framework sisi server (Server-Side).'],
            ['kode' => 'KT02', 'nama' => 'Frontend', 'deskripsi' => 'Framework antarmuka pengguna web (Client-Side).'],
            ['kode' => 'KT03', 'nama' => 'Mobile', 'deskripsi' => 'Framework aplikasi mobile (Android / iOS).'],
            ['kode' => 'KT04', 'nama' => 'Full Stack', 'deskripsi' => 'Framework frontend dan backend sekaligus.'],
        ];

        foreach ($categories as $cat) {
            KategoriFramework::updateOrCreate(['kode' => $cat['kode']], $cat);
        }
    }
}
