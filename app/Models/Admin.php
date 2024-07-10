<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'added_by', 'updated_by', 'active', 'date', 'com_code', 'roles_name' ,'employee_id'
    ];

    protected $casts = [
        'roles_name' => 'array',
    ];

    public function isNoRule()
    {
        return in_array('no_role', $this->roles_name);
    }

    public function isAdmin()
    {
        return in_array('admin', $this->roles_name);
    }

    public function isSuperAdmin()
    {
        return in_array('super_admin', $this->roles_name);
    }

    public function isManager()
    {
        return in_array('manager', $this->roles_name);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'admin_id', 'id');
    }

    public function additionalSalary()
    {
        return $this->hasOne(AdditionalSalary::class);
    }

    public function allowanceSalary()
    {
        return $this->hasOne(AllowanceSalary::class);
    }
}