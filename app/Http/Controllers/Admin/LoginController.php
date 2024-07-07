<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Attendance;

class LoginController extends Controller
{
    public function show_login_view()
    {
        return view('admin.auth.login');
        /*
    $admin['name']="admin";
     $admin['email']="test@gmail.com";
     $admin['username']="admin";
     $admin['password']=bcrypt("admin");
     $admin['active']=1;
     $admin['date']=date("Y-m-d");
     $admin['com_code']=1;
     $admin['added_by']=1;
     $admin['updated_by']=1;
     Admin::create($admin);
*/
    }

   public function login(Request $request)
    {
        if (auth()->guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            if (auth()->guard('admin')->user()->active == 1) {
                Attendance::create([
                    'admin_id' => auth()->guard('admin')->id(),
                    'login_time' => now(),
                ]);

                return redirect()->route('admin.dashboard');
            } else {
                auth()->guard('admin')->logout();
                return redirect()->route('admin.showlogin')->with(['error' => 'عفوا الحساب غير مفعل !!']);
            }
        } else {
            return redirect()->route('admin.showlogin')->with(['error' => 'عفوا بيانات التسجيل غير صحيحة !!']);
        }
    }

    public function logout(Request $request)
    {
        $attendance = Attendance::where('admin_id', auth()->guard('admin')->id())
            ->whereNull('logout_time')
            ->latest()
            ->first();
        if ($attendance) {

            $attendance->update([
                'logout_time' => now(),
            ]);
        }

        auth()->guard('admin')->logout();
        return redirect()->route('admin.showlogin');
    }


    public function show_register_view()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->added_by = 1; 
        $admin->updated_by = 1; 
        $admin->active = 1; 
        $admin->date = date("Y-m-d");
        $admin->com_code = 1; 
        $admin->save();

        return redirect()->route('admin.showlogin')->with(['success' => 'تم التسجيل بنجاح']);
   }
}
