<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $fillable=[
        'user_id',
        'nama_barang_temuan',
        'kategori',
        'waktu_temuan',
        'lokasi_temuan',
        'region_kampus',
        'deskripsi_umum',
        'deskripsi_khusus',
        'status',
        'foto_url',
        'approve_reject_reason',
    ];

    protected $casts = [
        'foto_url' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function claims(): hasMany
    {
        return $this->hasMany(Claim::class);
    }
}
