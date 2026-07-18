<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Framework;
use App\Models\KategoriFramework;

class FrameworkSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Backend (KT01)
            ['cat' => 'KT01', 'kode' => 'FW001', 'nama_framework' => 'Laravel', 'bahasa' => 'PHP', 'website' => 'https://laravel.com', 'deskripsi' => 'Framework PHP full-stack yang elegan dengan ekosistem lengkap, termasuk ORM Eloquent, Blade templating, dan autentikasi bawaan.'],
            ['cat' => 'KT01', 'kode' => 'FW002', 'nama_framework' => 'CodeIgniter 4', 'bahasa' => 'PHP', 'website' => 'https://codeigniter.com', 'deskripsi' => 'Framework PHP ringan dan cepat, ideal untuk aplikasi kecil-menengah dengan kurva belajar rendah.'],
            ['cat' => 'KT01', 'kode' => 'FW003', 'nama_framework' => 'Express.js', 'bahasa' => 'JavaScript', 'website' => 'https://expressjs.com', 'deskripsi' => 'Framework Node.js minimalis dan fleksibel untuk membangun web server dan API.'],
            ['cat' => 'KT01', 'kode' => 'FW004', 'nama_framework' => 'NestJS', 'bahasa' => 'TypeScript', 'website' => 'https://nestjs.com', 'deskripsi' => 'Framework Node.js progresif berbasis TypeScript dengan arsitektur modular terinspirasi Angular.'],
            ['cat' => 'KT01', 'kode' => 'FW005', 'nama_framework' => 'Django', 'bahasa' => 'Python', 'website' => 'https://www.djangoproject.com', 'deskripsi' => 'Framework Python batteries-included untuk pengembangan web cepat dan aman dengan admin panel bawaan.'],
            ['cat' => 'KT01', 'kode' => 'FW006', 'nama_framework' => 'FastAPI', 'bahasa' => 'Python', 'website' => 'https://fastapi.tiangolo.com', 'deskripsi' => 'Framework Python modern berkinerja tinggi untuk membangun API, dengan dukungan async dan dokumentasi otomatis.'],
            ['cat' => 'KT01', 'kode' => 'FW007', 'nama_framework' => 'Spring Boot', 'bahasa' => 'Java', 'website' => 'https://spring.io/projects/spring-boot', 'deskripsi' => 'Framework Java enterprise-grade yang kuat untuk membangun aplikasi skala besar dengan keamanan tinggi.'],
            ['cat' => 'KT01', 'kode' => 'FW008', 'nama_framework' => 'ASP.NET Core', 'bahasa' => 'C#', 'website' => 'https://dotnet.microsoft.com/apps/aspnet', 'deskripsi' => 'Framework cross-platform dari Microsoft untuk membangun aplikasi web modern, API, dan microservices.'],

            // Frontend (KT02)
            ['cat' => 'KT02', 'kode' => 'FW009', 'nama_framework' => 'React', 'bahasa' => 'JavaScript', 'website' => 'https://react.dev', 'deskripsi' => 'Library UI dari Meta untuk membangun antarmuka berbasis komponen yang reusable dan reactive.'],
            ['cat' => 'KT02', 'kode' => 'FW010', 'nama_framework' => 'Vue.js', 'bahasa' => 'JavaScript', 'website' => 'https://vuejs.org', 'deskripsi' => 'Framework JavaScript progresif yang ramah pemula untuk membangun antarmuka web modern.'],

            // Mobile (KT03)
            ['cat' => 'KT03', 'kode' => 'FW011', 'nama_framework' => 'Flutter', 'bahasa' => 'Dart', 'website' => 'https://flutter.dev', 'deskripsi' => 'SDK UI dari Google untuk membangun aplikasi multiplatform (Android, iOS, Web, Desktop) dari satu codebase.'],

            // Full Stack (KT04)
            ['cat' => 'KT04', 'kode' => 'FW012', 'nama_framework' => 'Next.js', 'bahasa' => 'JavaScript', 'website' => 'https://nextjs.org', 'deskripsi' => 'Framework React full-stack yang mendukung SSR, SSG, dan API Routes untuk aplikasi produksi.'],
        ];

        foreach ($data as $fw) {
            $kategori = KategoriFramework::where('kode', $fw['cat'])->first();
            if (!$kategori) continue;

            Framework::updateOrCreate(['kode' => $fw['kode']], [
                'kategori_framework_id' => $kategori->id,
                'kode' => $fw['kode'],
                'nama_framework' => $fw['nama_framework'],
                'bahasa' => $fw['bahasa'],
                'website' => $fw['website'],
                'deskripsi' => $fw['deskripsi'],
                'logo' => null,
            ]);
        }
    }
}
