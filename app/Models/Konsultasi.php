<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'nama',
        'email',
        'tanggal',
        'jenis_proyek_id',
    ];

    public function jenisProyek(): BelongsTo
    {
        return $this->belongsTo(JenisProyek::class, 'jenis_proyek_id');
    }

    public function jawabanKonsultasis(): HasMany
    {
        return $this->hasMany(JawabanKonsultasi::class, 'konsultasi_id');
    }

    public function hasilKonsultasis(): HasMany
    {
        return $this->hasMany(HasilKonsultasi::class, 'konsultasi_id');
    }
}
