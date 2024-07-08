<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminstrationStaffRequest;
use App\Models\AdminstrationStaffDetail;

class AdministrationStaffController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $staffDetails = AdminstrationStaffDetail::with('admin')->get();
        } else {
            $staffDetails = AdminstrationStaffDetail::where('admin_id', auth()->id())->with('admin')->get();
        }
        return view('admin.adminstration_staff.index', compact('staffDetails'));
    }

    public function create()
    {
        $admins = Admin::where('active',1)->get();
        return view("admin.adminstration_staff.create", compact("admins"));
    }

    public function store(AdminstrationStaffRequest $request)
    {
        $exists = AdminstrationStaffDetail::where('admin_id', $request->admin_id)
                                          ->where('department_name', $request->department)
                                          ->exists();
    
        if ($exists) {
            return redirect()->route('Administration_staff.index')->with('error', 'هذا الموظف موجود في القسم بالفعل');
        }
    
        AdminstrationStaffDetail::create([
            'admin_id' => $request->admin_id,
            'department_name' => $request->department,
        ]);
    
        return redirect()->route('Administration_staff.index')->with('success', 'تم إضافة الموظف للقسم بنجاح');
    }
    
}
