<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'type',
        'basic_salary',
        'allowance_amount',
        'total_salary',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
