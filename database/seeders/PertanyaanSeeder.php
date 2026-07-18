<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'JP01', 'pertanyaan' => 'Apa yang ingin Anda bangun?', 'tipe' => 'radio', 'urutan' => 0],
            ['kode' => 'P01', 'pertanyaan' => 'Bahasa pemrograman apa yang akan Anda gunakan?', 'tipe' => 'radio', 'urutan' => 1],
            ['kode' => 'P02', 'pertanyaan' => 'Tingkat pengalaman Anda sebagai developer?', 'tipe' => 'radio', 'urutan' => 2],
            ['kode' => 'P03', 'pertanyaan' => 'Berapa jumlah anggota tim pengembang?', 'tipe' => 'radio', 'urutan' => 3],
            ['kode' => 'P04', 'pertanyaan' => 'Target penyelesaian proyek?', 'tipe' => 'radio', 'urutan' => 4],
            ['kode' => 'P05', 'pertanyaan' => 'Berapa perkiraan jumlah pengguna aplikasi?', 'tipe' => 'radio', 'urutan' => 5],
            ['kode' => 'P06', 'pertanyaan' => 'Platform utama aplikasi?', 'tipe' => 'radio', 'urutan' => 6],
            ['kode' => 'P07', 'pertanyaan' => 'Apakah aplikasi diperkirakan akan terus dikembangkan di masa depan?', 'tipe' => 'radio', 'urutan' => 7],
            ['kode' => 'P08', 'pertanyaan' => 'Apakah aplikasi membutuhkan REST API? (REST API: jembatan komunikasi data antar aplikasi, misalnya menghubungkan frontend web dengan database backend)', 'tipe' => 'radio', 'urutan' => 8],
            ['kode' => 'P09', 'pertanyaan' => 'Apakah membutuhkan sistem autentikasi bawaan? (Autentikasi: fitur pendaftaran akun, login, logout, dan pembatasan hak akses)', 'tipe' => 'radio', 'urutan' => 9],
            ['kode' => 'P10', 'pertanyaan' => 'Apakah membutuhkan komunikasi real-time (WebSocket)? (WebSocket: koneksi instan dua arah tanpa reload, contoh: aplikasi chat, live update, atau notifikasi langsung)', 'tipe' => 'radio', 'urutan' => 10],
            ['kode' => 'P11', 'pertanyaan' => 'Apakah SEO menjadi prioritas? (SEO / Search Engine Optimization: optimasi agar website Anda mudah dicari dan muncul di halaman pertama Google)', 'tipe' => 'radio', 'urutan' => 11],
            ['kode' => 'P12', 'pertanyaan' => 'Apakah membutuhkan Server Side Rendering (SSR)? (SSR: proses merender halaman web di server, sangat berguna untuk mempercepat loading awal dan optimasi SEO)', 'tipe' => 'radio', 'urutan' => 12],
            ['kode' => 'P13', 'pertanyaan' => 'Apakah aplikasi harus berjalan di Android dan iOS?', 'tipe' => 'radio', 'urutan' => 13],
            ['kode' => 'P14', 'pertanyaan' => 'Seberapa penting performa aplikasi?', 'tipe' => 'radio', 'urutan' => 14],
            ['kode' => 'P15', 'pertanyaan' => 'Seberapa penting keamanan aplikasi?', 'tipe' => 'radio', 'urutan' => 15],
            ['kode' => 'P16', 'pertanyaan' => 'Seberapa penting skalabilitas aplikasi? (Skalabilitas: kemampuan aplikasi untuk menangani lonjakan jumlah pengguna yang bertambah drastis tanpa lag)', 'tipe' => 'radio', 'urutan' => 16],
            ['kode' => 'P17', 'pertanyaan' => 'Seberapa penting dokumentasi framework?', 'tipe' => 'radio', 'urutan' => 17],
            ['kode' => 'P18', 'pertanyaan' => 'Seberapa penting komunitas framework?', 'tipe' => 'radio', 'urutan' => 18],
            ['kode' => 'P19', 'pertanyaan' => 'Seberapa penting kemudahan maintenance? (Maintenance: kemudahan pemeliharaan kode, perbaikan bug, dan penambahan fitur di masa depan)', 'tipe' => 'radio', 'urutan' => 19],
            ['kode' => 'P20', 'pertanyaan' => 'Seberapa penting kemudahan mempelajari framework?', 'tipe' => 'radio', 'urutan' => 20],
        ];

        foreach ($data as $item) {
            Pertanyaan::updateOrCreate(['kode' => $item['kode']], array_merge($item, ['aktif' => true]));
        }
    }
}
