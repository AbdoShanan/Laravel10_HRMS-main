<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.permissions.index',compact('roles'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.permissions.create',compact('permission'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required|array', 
            ]);
        
            $role = Role::create(['name' => $request->input('name')]);
            $permissions = array_map('intval', $request->input('permission'));
    
            $role->syncPermissions($permissions);
        
            return redirect()->route('permissions.index')
                            ->with('success', 'تم حفظ الصلاحية بنجاح');
        } catch(\Exception $ex) {
            return redirect()->route('permissions.index')
                            ->with('error', 'حدث خطأ ما');
        }
    }
    
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        return view('admin.permissions.edit',compact('role','permission','rolePermissions'));
    }
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, $id)
     {
        $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $permissions = array_map('intval', $request->input('permission'));
        $role->syncPermissions($permissions);
        return redirect()->route('permissions.index')
        ->with('success','تم التحديث بنجاح');
     }
        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
     public function delete($id)
        {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
        ->with('success','تم الحذف بنجاح');
     }
  }