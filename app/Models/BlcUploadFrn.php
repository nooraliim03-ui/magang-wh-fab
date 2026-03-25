<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlcUploadFrn extends Model
{
    use HasFactory;

    protected $fillable = [
        'kp',
        'user_id',
        'style',
        'country',
        'item',
        'color',
        'relax',
        'qty_request',
        'blc',
        'podo',
        'kendala',
        'keterangan',
    ];

    protected $appends = [
        'current_filled',
        'progress'
    ];

    protected $casts = [
    'podo' => 'date',
];

 
    public function getCurrentFilledAttribute(): float
    {
        $filled = $this->qty_request + $this->blc;

        return max(0, $filled);
    }

 
    public function getProgressAttribute(): float
    {
        if ($this->qty_request <= 0) {
            return 0;
        }

        $filled = $this->current_filled;

        $progress = ($filled / $this->qty_request) * 100;

        return max(0, $progress);
    }

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}