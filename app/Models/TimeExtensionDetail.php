<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeExtensionDetail extends Model
{
    protected $fillable = [
        'contracting_id',
        'extra_time',
    ];

    public function contracting()
    {
        return $this->belongsTo(Contracting::class);
    }
}
