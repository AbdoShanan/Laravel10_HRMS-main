<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends  Authenticatable
{
    use HasFactory , HasRoles;
    
    protected $table="admins";
    protected $fillable=[
       'name','email','username','password','added_by','updated_by','active','date','created_at','updated_at','com_code' ,'roles_name'

    ];

    protected $casts = [
       'roles_name' =>'array',
    ];
}
