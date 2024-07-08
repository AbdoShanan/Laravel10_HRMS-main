<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryDeductionRequest;
use App\Models\Admin;
use App\Models\SalaryDeduction;
use Illuminate\Http\Request;

class SalaryDeductionController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $deductions = SalaryDeduction::with('admin')->get();
        } else {
            $deductions = SalaryDeduction::where('admin_id', auth()->id())->with('admin')->get();
        }
        return view('admin.salary_deductions.index', compact('deductions'));
    }

    public function create()
    {
        $admins = Admin::where('active', 1)->get();
        return view('admin.salary_deductions.create', compact('admins'));
    }

    public function store(SalaryDeductionRequest $request)
    {
        SalaryDeduction::create($request->all());

        return redirect()->route('salary_deductions.index')->with('success', 'تم إضافة الخصم بنجاح');
    }
}
