<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    $user = Admin::create([
    'name'         => 'abdelrahman',
    'username'     => 'abdelrahman',
    'email'        => 'admin@gmail.com',
    'password'     => bcrypt('123456'),
    'added_by'     => 1,
    'updated_by'   => 1,
    'com_code'     => 1,
    'active'       => 1,
    'date'         => date("Y-m-d"),
    'roles_name'   => ['admin'],

    ]);
    $role = Role::create(['name' => 'admin', 'guard_name' => 'admin']);

    $permissions = Permission::pluck('id','id')->all();

    $role->syncPermissions($permissions);

    $user->assignRole([$role->id]);

    }   
}