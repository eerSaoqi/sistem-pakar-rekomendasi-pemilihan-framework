<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Framework extends Model
{
    use HasFactory;

    protected $table = 'framework';

    protected $fillable = [
        'kategori_framework_id',
        'kode',
        'nama_framework',
        'bahasa',
        'website',
        'deskripsi',
        'logo',
    ];

    public function kategoriFramework(): BelongsTo
    {
        return $this->belongsTo(KategoriFramework::class, 'kategori_framework_id');
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class, 'framework_id');
    }

    public function hasilKonsultasis(): HasMany
    {
        return $this->hasMany(HasilKonsultasi::class, 'framework_id');
    }
}
