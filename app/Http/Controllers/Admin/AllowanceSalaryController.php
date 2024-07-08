<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AllowanceSalaryRequest;
use App\Models\AllowanceSalary;

class AllowanceSalaryController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {
            $allowanceSalaries = AllowanceSalary::with('admin')->get();
        } else {
            $allowanceSalaries = AllowanceSalary::where('admin_id', auth()->id())->with('admin')->get();
        }
        return view('admin.allowance_salary.index', compact('allowanceSalaries'));
    }

    public function create()
    {
        $admins = Admin::where('active', 1)->get();
        return view('admin.allowance_salary.create', compact('admins'));
    }

    public function store(AllowanceSalaryRequest $request)
    {
        $totalSalary = $request->basic_salary + $request->allowance_amount;

        AllowanceSalary::create([
            'admin_id' => $request->admin_id,
            'type' => $request->type,
            'basic_salary' => $request->basic_salary,
            'allowance_amount' => $request->allowance_amount,
            'total_salary' => $totalSalary,
        ]);

        return redirect()->route('allowance_salary.index')->with('success', 'تم إضافة بدل الراتب بنجاح');
    }
}
