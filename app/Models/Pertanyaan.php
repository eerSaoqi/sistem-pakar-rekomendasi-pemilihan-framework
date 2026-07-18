<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'kode',
        'pertanyaan',
        'tipe',
        'urutan',
        'aktif',
    ];

    public function kategoriFrameworks(): BelongsToMany
    {
        return $this->belongsToMany(
            KategoriFramework::class,
            'kategori_pertanyaan',
            'pertanyaan_id',
            'kategori_framework_id'
        );
    }

    public function opsiJawabans(): HasMany
    {
        return $this->hasMany(OpsiJawaban::class, 'pertanyaan_id')->orderBy('urutan');
    }

    public function knowledgeBases(): HasMany
    {
        return $this->hasMany(KnowledgeBase::class, 'pertanyaan_id');
    }
}
