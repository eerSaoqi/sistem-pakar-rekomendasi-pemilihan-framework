<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_konsultasi';

    protected $fillable = [
        'konsultasi_id',
        'framework_id',
        'nilai_cf',
        'persentase',
        'ranking',
    ];

    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class, 'konsultasi_id');
    }

    public function framework(): BelongsTo
    {
        return $this->belongsTo(Framework::class, 'framework_id');
    }
}
