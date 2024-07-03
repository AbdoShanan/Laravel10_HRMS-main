<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use Spatie\Permission\Models\Role; 
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('admin.admins.create' , compact('roles'));
    }

    public function store(CreateRequest $request)
    { 
       $user = Admin::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'username'    => $request->name,
            'roles_name'  => $request->roles_name,
            'password'    => Hash::make($request->password),
            'added_by'    => auth()->user()->added_by,
            'updated_by'  => auth()->user()->updated_by, 
            'active'      => $request->status, 
            'date'        => date("Y-m-d"),
            'com_code'    => auth()->user()->com_code, 
        ]);
    
        $user->assignRole($request->input('roles_name'));
    
        return redirect()->route('admins.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }
    
    public function edit(Admin $admin)
    {
        $roles = Role::pluck('name','name')->all();
        $userRole = $admin->roles->pluck('name','name')->all();
        return view('admin.admins.edit', compact('admin','roles','userRole'));
    }

    public function update(UpdateRequest $request, Admin $admin)
    {
        $admin->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'username'    => $request->name,
            'password'    => Hash::make($request->password) ?? $admin->password,
            'active'      =>$request->status, 
            'roles_name'  => $request->roles_name,


        ]);
        DB::table('model_has_roles')->where('model_id',$admin->id)->delete();
        $admin->assignRole($request->input('roles_name'));
        return redirect()->route('admins.index')->with('success', 'تم تعديل بيانات المستخدم بنجاح');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
