<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriFramework extends Model
{
    use HasFactory;

    protected $table = 'kategori_framework';

    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
    ];

    public function frameworks(): HasMany
    {
        return $this->hasMany(Framework::class, 'kategori_framework_id');
    }

    public function pertanyaans(): BelongsToMany
    {
        return $this->belongsToMany(
            Pertanyaan::class,
            'kategori_pertanyaan',
            'kategori_framework_id',
            'pertanyaan_id'
        )->orderBy('urutan');
    }

    public function jenisProyeks(): BelongsToMany
    {
        return $this->belongsToMany(
            JenisProyek::class,
            'jenis_proyek_kategori',
            'kategori_framework_id',
            'jenis_proyek_id'
        );
    }
}
