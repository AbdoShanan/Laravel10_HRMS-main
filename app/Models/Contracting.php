<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TimeExtensionDetail;

class Contracting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_id',
        'title',
        'description',
        'review',
        'timer',
        'status'
    ];

    /**
     * Get the admin that owns the task.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function timeExtensions()
    {
        return $this->hasMany(TimeExtensionDetail::class);
    }
    
}
