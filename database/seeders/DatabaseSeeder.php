<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Call independent seeders in order
        $this->call([
            KategoriFrameworkSeeder::class,
            JenisProyekSeeder::class,
            JenisProyekKategoriSeeder::class,
            FrameworkSeeder::class,
            PertanyaanSeeder::class,
            OpsiJawabanSeeder::class,
            KategoriPertanyaanSeeder::class,
            KnowledgeBaseSeeder::class,
        ]);
    }
}
