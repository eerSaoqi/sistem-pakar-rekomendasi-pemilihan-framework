<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProyek extends Model
{
    use HasFactory;

    protected $table = 'jenis_proyek';
    protected $guarded = ['id'];

    public function kategoriFrameworks()
    {
        return $this->belongsToMany(KategoriFramework::class, 'jenis_proyek_kategori', 'jenis_proyek_id', 'kategori_framework_id');
    }
}
