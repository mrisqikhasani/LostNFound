<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Claim extends Model
{
    protected $fillable = [
        'user_id',
        'report_id',
        'deskripsi_verifikasi',
        'foto_verifikasi',
        'status_klaim',
        'tanggal_klaim',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function report():BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    protected static function booted()
    {
        static::updated(function($claim) {
            if ($claim->isDirty('status_klaim') && $claim->status_klaim === 'disetujui') {
                $claim->report->update(['status' => 'diklaim']);
            }
        });
    }

}
