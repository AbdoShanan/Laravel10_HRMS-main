<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminstrationStaffDetail extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'department_name'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
