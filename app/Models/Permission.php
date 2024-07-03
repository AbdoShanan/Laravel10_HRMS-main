<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Permission extends  Authenticatable
{
    use HasFactory , HasRoles;
    
    protected $table="permissions";
    protected $fillable=[
       'name','guard_name'

    ];

}
