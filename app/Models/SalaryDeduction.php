<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'type',
        'basic_salary',
        'deduction_amount',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
