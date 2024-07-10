<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branche;
use App\Models\Departement;
use App\Models\jobs_categorie;
use App\Models\Qualification;
use App\Models\Religion;
use App\Models\Countries;
use App\Models\Nationalitie;
use App\Models\governorates;
use App\Models\centers;
use App\Models\blood_groups;
use App\Models\Military_status;
use App\Models\driving_license_type;
use App\Models\Language;
use App\Models\Shifts_type;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use DB;

class EmployeesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()) {

            $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);

        } else {

            $data = get_cols_where(new Employee(), array("*"), array("com_code" => $com_code,"id"=>auth()->user()->employee_id), "id", "DESC", PC);
        }

        return view("admin.Employees.index", ['data' => $data]);
    }
    public function create()
    {
        $com_code = auth()->user()->com_code;
        $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['departements'] = get_cols_where(new Departement(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['jobs'] = get_cols_where(new jobs_categorie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['qualifications'] = get_cols_where(new Qualification(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['religions'] = get_cols_where(new Religion(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['nationalities'] = get_cols_where(new Nationalitie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['countires'] = get_cols_where(new Countries(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['blood_groups'] = get_cols_where(new blood_groups(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['military_status'] = get_cols_where(new Military_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driving_license_types'] = get_cols_where(new driving_license_type(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['shifts_types'] = get_cols_where(new Shifts_type(), array("id", "type","from_time","to_time","total_hour"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['languages'] = get_cols_where(new Language(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');

        return view("admin.Employees.create", ['other' => $other]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $validated = $request->validated();
            $employee = new Employee();
            $employee->fill($validated); 
            $employee->added_by = auth()->user()->id;
            $employee->com_code = auth()->user()->com_code;
            $employee->password = Hash::make($request->password);
            $employee->Motivation = $employee->Motivation ?? 0;
        
            if ($request->hasFile('emp_photo')) {
                $photoPath = $request->file('emp_photo')->store('photos', 'public');
                $employee->emp_photo = $photoPath;
            }
        
            if ($request->hasFile('emp_CV')) {
                $cvPath = $request->file('emp_CV')->store('cvs', 'public');
                $employee->emp_CV = $cvPath;
            }
        
            $employee->save();
    
            // Insert new record in admins table
            $user = Admin::create([
                'name'        => $request->emp_name,
                'employee_id' => $employee->id,
                'email'       => $request->emp_email,
                'username'    => $request->emp_name,
                'roles_name'  => ["no_role"], 
                'password'    => Hash::make($request->password),
                'added_by'    => auth()->user()->added_by,
                'updated_by'  => auth()->user()->updated_by, 
                'active'      => 1, 
                'date'        => date("Y-m-d"),
                'com_code'    => auth()->user()->com_code, 
            ]);
    
            $user->assignRole($request->input('roles_name')); 
    
            return redirect()->route('Employees.index')->with('success', 'تم إضافة الموظف بنجاح.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة الموظف: ' . $e->getMessage());
        }
    }
    

    public function get_governorates(Request $request)
    {
        if ($request->ajax()) {
            $country_id = $request->country_id;
            $other['governorates'] = get_cols_where(new governorates(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'countires_id' => $country_id));
            return view('admin.Employees.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.Employees.get_centers',['other'=>$other]);
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        if (!$employee)
        {
            return redirect()->route('Employees.index')
            ->with('error','هذا الموظف غير موجود !');
        }
        $com_code = auth()->user()->com_code;
        $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['military_status'] = get_cols_where(new Military_status(), array("id", "name"), array("active" => 1),'id','ASC');


        return view ('admin.Employees.edit', compact("employee","other"));
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                return redirect()->route('Employees.index')
                    ->with('error', 'هذا الموظف غير موجود !');
            }
    
            $validated = $request->validated();
            $employee->fill($validated);
    
            $employee->updated_by = auth()->user()->id;
            $employee->com_code = auth()->user()->com_code;
    
            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }
    
            if ($request->hasFile('emp_photo')) {
                $photoPath = $request->file('emp_photo')->store('photos', 'public');
                $employee->emp_photo = $photoPath;
            }
    
            if ($request->hasFile('emp_CV')) {
                $cvPath = $request->file('emp_CV')->store('cvs', 'public');
                $employee->emp_CV = $cvPath;
            }
    
            $employee->save();
    
            // Update  Admin record for this employee
            $admin = Admin::where('employee_id', $employee->id)->first();
            if ($admin) {
                $admin->name = $request->emp_name;
                $admin->username = $request->emp_name;
                $admin->added_by = auth()->user()->id;
                $admin->updated_by = auth()->user()->id;
                $admin->active = 1;
                $admin->date = date("Y-m-d");
                $admin->com_code = auth()->user()->com_code;

                if ($request->filled('password')) {
                    $admin->password = Hash::make($request->password);
                }
    
                $admin->save();
    
            }
    
            return redirect()->route('Employees.index')->with('success', 'تم تعديل الموظف بنجاح.');
    
        } catch (\Exception $e) {
            return redirect()->route('Employees.index')->with('error', 'حدث خطأ أثناء تعديل الموظف: ' . $e->getMessage());
        }
    }
    
    


    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee)
        {
            return redirect()->route('Employees.index')
            ->with('error','هذا الموظف غير موجود !');
        }
        $employee->delete();
        return redirect()->route('Employees.index')
        ->with('success','تم الحذف بنجاح');
    }
}
