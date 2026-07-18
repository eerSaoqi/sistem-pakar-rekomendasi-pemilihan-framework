<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. kategori_framework
        Schema::create('kategori_framework', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 50);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // 1a. jenis_proyek
        Schema::create('jenis_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 100);
            $table->timestamps();
        });

        // 1b. jenis_proyek_kategori
        Schema::create('jenis_proyek_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_proyek_id')->constrained('jenis_proyek')->cascadeOnDelete();
            $table->foreignId('kategori_framework_id')->constrained('kategori_framework')->cascadeOnDelete();
            $table->timestamps();
        });

        // 2. framework
        Schema::create('framework', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_framework_id')->constrained('kategori_framework')->cascadeOnDelete();
            $table->string('kode', 10)->unique();
            $table->string('nama_framework', 50);
            $table->string('bahasa', 50);
            $table->string('website')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // 3. pertanyaan
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->text('pertanyaan');
            $table->string('tipe', 20)->default('radio'); // e.g., radio, select
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 4. kategori_pertanyaan
        Schema::create('kategori_pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_framework_id')->constrained('kategori_framework')->cascadeOnDelete();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->timestamps();
        });

        // 5. opsi_jawaban
        Schema::create('opsi_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->string('kode', 10);
            $table->string('jawaban', 100);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 6. knowledge_base
        Schema::create('knowledge_base', function (Blueprint $table) {
            $table->id();
            $table->foreignId('framework_id')->constrained('framework')->cascadeOnDelete();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->foreignId('opsi_jawaban_id')->constrained('opsi_jawaban')->cascadeOnDelete();
            $table->decimal('cf_pakar', 5, 2);
            $table->timestamps();
        });

        // 8. konsultasi
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->dateTime('tanggal');
            $table->foreignId('jenis_proyek_id')->constrained('jenis_proyek')->cascadeOnDelete();
            $table->timestamps();
        });

        // 9. jawaban_konsultasi
        Schema::create('jawaban_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasi')->cascadeOnDelete();
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->cascadeOnDelete();
            $table->foreignId('opsi_jawaban_id')->constrained('opsi_jawaban')->cascadeOnDelete();
            $table->decimal('cf_user', 5, 2);
            $table->timestamps();
        });

        // 10. hasil_konsultasi
        Schema::create('hasil_konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasi')->cascadeOnDelete();
            $table->foreignId('framework_id')->constrained('framework')->cascadeOnDelete();
            $table->decimal('nilai_cf', 5, 4);
            $table->decimal('persentase', 5, 2);
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_konsultasi');
        Schema::dropIfExists('jawaban_konsultasi');
        Schema::dropIfExists('konsultasi');
        Schema::dropIfExists('knowledge_base');
        Schema::dropIfExists('opsi_jawaban');
        Schema::dropIfExists('kategori_pertanyaan');
        Schema::dropIfExists('pertanyaan');
        Schema::dropIfExists('framework');
        Schema::dropIfExists('jenis_proyek_kategori');
        Schema::dropIfExists('jenis_proyek');
        Schema::dropIfExists('kategori_framework');
    }
};
