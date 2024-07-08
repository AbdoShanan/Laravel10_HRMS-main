<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdditionalSalary;
use App\Http\Requests\AdditionalSalaryRequest;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdditionalSalaryController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $additionalSalaries = AdditionalSalary::with('admin')->get();
        } else {
            $additionalSalaries = AdditionalSalary::where('admin_id', auth()->id())->with('admin')->get();
        }
        return view('admin.additional_salary.index', compact('additionalSalaries'));
    }

    public function create()
    {
        $admins = Admin::where('active', 1)->get();
        return view('admin.additional_salary.create', compact('admins'));
    }

    public function store(AdditionalSalaryRequest $request)
    {
        $totalAmount = $request->basic_salary + $request->additional_amount;

        AdditionalSalary::create([
            'admin_id' => $request->admin_id,
            'type' => $request->type,
            'basic_salary' => $request->basic_salary,
            'additional_amount' => $request->additional_amount,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('additional_salary.index')->with('success', 'تم إضافة نوع الإضافي بنجاح');
    }
}
