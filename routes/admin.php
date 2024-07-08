<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Admin_panel_settingController;
use App\Http\Controllers\Admin\Finance_calendersController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\ShiftsTypesController;
use App\Http\Controllers\Admin\DepartementsController;
use App\Http\Controllers\Admin\Jobs_categoriesController;;
 
use App\Http\Controllers\Admin\QualificationsController;
use App\Http\Controllers\Admin\OccasionsController;
use App\Http\Controllers\Admin\ResignationsController;
use App\Http\Controllers\Admin\NationalitiesController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\ContractingController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AdministrationStaffController;
use App\Http\Controllers\Admin\AdditionalSalaryController;
use App\Http\Controllers\Admin\AllowanceSalaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

define('PC', 11);
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    /*  بداية الضبط العام */
    Route::get('/generalSettings', [Admin_panel_settingController::class, 'index'])->name('admin_panel_settings.index');
    Route::get('/generalSettingsEdit', [Admin_panel_settingController::class, 'edit'])->name('admin_panel_settings.edit');
    Route::get('/generalSettingsupdate', [Admin_panel_settingController::class, 'update'])->name('admin_panel_settings.update');
    /*  بداية  تكويد السنوات المالية */
    Route::get('/finance_calender/delete/{id}', [Finance_calendersController::class, 'destroy'])->name('finance_calender.delete');
    Route::post('/finance_calender/show_year_monthes', [Finance_calendersController::class, 'show_year_monthes'])->name('finance_calender.show_year_monthes');
    Route::get('/finance_calender/do_open/{id}', [Finance_calendersController::class, 'do_open'])->name('finance_calender.do_open');
    Route::resource('/finance_calender', Finance_calendersController::class);
    /* بداية الفروع */
    Route::get("/branches", [BranchesController::class, 'index'])->name('branches.index');
    Route::get("/branchesCreate", [BranchesController::class, 'create'])->name('branches.create');
    Route::post("/branchesStore", [BranchesController::class, 'store'])->name('branches.store');
    Route::get("/branchesEdit/{id}", [BranchesController::class, 'edit'])->name('branches.edit');
    Route::post("/branchesUpdate/{id}", [BranchesController::class, 'update'])->name('branches.update');
    Route::get("/branchesDelete/{id}", [BranchesController::class, 'destroy'])->name('branches.destroy');
    /* بداية انواع شفتات الموظفين */
    Route::get("/ShiftsTypes", [ShiftsTypesController::class, 'index'])->name('ShiftsTypes.index');
    Route::get("/ShiftsTypesCreate", [ShiftsTypesController::class, 'create'])->name('ShiftsTypes.create');
    Route::post("/ShiftsTypesStore", [ShiftsTypesController::class, 'store'])->name('ShiftsTypes.store');
    Route::get("/ShiftsTypesEdit/{id}", [ShiftsTypesController::class, 'edit'])->name('ShiftsTypes.edit');
    Route::post("/ShiftsTypesUpdate/{id}", [ShiftsTypesController::class, 'update'])->name('ShiftsTypes.update');
    Route::get("/ShiftsTypesDestroy/{id}", [ShiftsTypesController::class, 'destroy'])->name('ShiftsTypes.destroy');
    Route::post("/ShiftsTypesajax_search/", [ShiftsTypesController::class, 'ajax_search'])->name('ShiftsTypes.ajax_search');
    /*  بداية الادارات*/
    Route::get('/departements', [DepartementsController::class, 'index'])->name('departements.index');
    Route::get('/departementsCreate', [DepartementsController::class, 'create'])->name('departements.create');
    Route::post('/departementsStore', [DepartementsController::class, 'store'])->name('departements.store');
    Route::get('/departementsEdit/{id}', [DepartementsController::class, 'edit'])->name('departements.edit');
    Route::post('/departementsUpdate/{id}', [DepartementsController::class, 'update'])->name('departements.update');
    Route::get('/departementsDestroy/{id}', [DepartementsController::class, 'destroy'])->name('departements.destroy');
    /*  بداية فئات الوظائف*/
    Route::get('/jobs_categories', [Jobs_categoriesController::class, 'index'])->name('jobs_categories.index');
    Route::get('/jobs_categoriesCreate', [Jobs_categoriesController::class, 'create'])->name('jobs_categories.create');
    Route::post('/jobs_categoriesStore', [Jobs_categoriesController::class, 'store'])->name('jobs_categories.store');
    Route::get('/jobs_categoriesEdit/{id}', [Jobs_categoriesController::class, 'edit'])->name('jobs_categories.edit');
    Route::post('/jobs_categoriesUpdate/{id}', [Jobs_categoriesController::class, 'update'])->name('jobs_categories.update');
    Route::get('/jobs_categoriesDestroy/{id}', [Jobs_categoriesController::class, 'destroy'])->name('jobs_categories.destroy');
    /*  بداية مؤهلات الموظفين*/
    Route::get('/Qualifications', [QualificationsController::class, 'index'])->name('Qualifications.index');
    Route::get('/QualificationsCreate', [QualificationsController::class, 'create'])->name('Qualifications.create');
    Route::post('/QualificationsStore', [QualificationsController::class, 'store'])->name('Qualifications.store');
    Route::get('/QualificationsEdit/{id}', [QualificationsController::class, 'edit'])->name('Qualifications.edit');
    Route::post('/QualificationsUpdate/{id}', [QualificationsController::class, 'update'])->name('Qualifications.update');
    Route::get('/QualificationsDestroy/{id}', [QualificationsController::class, 'destroy'])->name('Qualifications.destroy');
    /*  بداية  المناسبات الرسمية*/
    Route::get('/occasions', [OccasionsController::class, 'index'])->name('occasions.index');
    Route::get('/occasionsCreate', [OccasionsController::class, 'create'])->name('occasions.create');
    Route::post('/occasionsStore', [OccasionsController::class, 'store'])->name('occasions.store');
    Route::get('/occasionsEdit/{id}', [OccasionsController::class, 'edit'])->name('occasions.edit');
    Route::post('/occasionsUpdate/{id}', [OccasionsController::class, 'update'])->name('occasions.update');
    Route::get('/occasionsDestroy/{id}', [OccasionsController::class, 'destroy'])->name('occasions.destroy');


    /*  بداية  انواع ترك العمل */
    Route::get('/Resignations', [ResignationsController::class, 'index'])->name('Resignations.index');
    Route::get('/ResignationsCreate', [ResignationsController::class, 'create'])->name('Resignations.create');
    Route::post('/ResignationsStore', [ResignationsController::class, 'store'])->name('Resignations.store');
    Route::get('/ResignationsEdit/{id}', [ResignationsController::class, 'edit'])->name('Resignations.edit');
    Route::post('/ResignationsUpdate/{id}', [ResignationsController::class, 'update'])->name('Resignations.update');
    Route::get('/ResignationsDestroy/{id}', [ResignationsController::class, 'destroy'])->name('Resignations.destroy');

    /*  بداية  انواع  الجنسيات */
    Route::get('/Nationalities', [NationalitiesController::class, 'index'])->name('Nationalities.index');
    Route::get('/NationalitiesCreate', [NationalitiesController::class, 'create'])->name('Nationalities.create');
    Route::post('/NationalitiesStore', [NationalitiesController::class, 'store'])->name('Nationalities.store');
    Route::get('/NationalitiesEdit/{id}', [NationalitiesController::class, 'edit'])->name('Nationalities.edit');
    Route::post('/NationalitiesUpdate/{id}', [NationalitiesController::class, 'update'])->name('Nationalities.update');
    Route::get('/NationalitiesDestroy/{id}', [NationalitiesController::class, 'destroy'])->name('Nationalities.destroy');

    /*  بداية  انواع  الديانات */
    Route::get('/Religions/index', [ReligionController::class, 'index'])->name('Religions.index');
    Route::get('/Religions/create', [ReligionController::class, 'create'])->name('Religions.create');
    Route::post('/Religions/store', [ReligionController::class, 'store'])->name('Religions.store');
    Route::get('/Religions/edit/{id}', [ReligionController::class, 'edit'])->name('Religions.edit');
    Route::post('/Religions/update/{id}', [ReligionController::class, 'update'])->name('Religions.update');
    Route::get('/Religions/destroy/{id}', [ReligionController::class, 'destroy'])->name('Religions.destroy');

    /*  بداية  الموظفين   */
    Route::get('/Employees/index', [EmployeesController::class, 'index'])->name('Employees.index');
    Route::get('/Employees/create', [EmployeesController::class, 'create'])->name('Employees.create');
    Route::post('/Employees/store', [EmployeesController::class, 'store'])->name('Employees.store');
    Route::get('/Employees/edit/{id}', [EmployeesController::class, 'edit'])->name('Employees.edit');
    Route::post('/Employees/update/{id}', [EmployeesController::class, 'update'])->name('Employees.update');
    Route::get('/Employees/destroy/{id}', [EmployeesController::class, 'destroy'])->name('Employees.destroy');
    Route::post("/Employees/get_governorates", [EmployeesController::class, 'get_governorates'])->name('Employees.get_governorates');
    Route::post("/Employees/get_centers", [EmployeesController::class, 'get_centers'])->name('Employees.get_centers');

    /*  بداية  بيانات موظفين الإدارة   */
    Route::get('/Administration_staff/index', [AdministrationStaffController::class, 'index'])->name('Administration_staff.index');
    Route::get('/Administration_staff/create', [AdministrationStaffController::class, 'create'])->name('Administration_staff.create');
    Route::post('/Administration_staff/store', [AdministrationStaffController::class, 'store'])->name('Administration_staff.store');

    
    /*      انواع الاضافي للراتب    */
    Route::get('/employees_additional_salary/index', [AdditionalSalaryController::class, 'index'])->name('additional_salary.index');
    Route::get('/employees_additional_salary/create', [AdditionalSalaryController::class, 'create'])->name('additional_salary.create');
    Route::post('/employees_additional_salary/store', [AdditionalSalaryController::class, 'store'])->name('additional_salary.store');
    
    /* انواع البدلات للراتب */
    Route::get('/allowance_salary/index', [AllowanceSalaryController::class, 'index'])->name('allowance_salary.index');
    Route::get('/allowance_salary/create', [AllowanceSalaryController::class, 'create'])->name('allowance_salary.create');
    Route::post('/allowance_salary/store', [AllowanceSalaryController::class, 'store'])->name('allowance_salary.store');

});


Route::group([ 'prefix' => 'admin' , 'middleware' => ['auth:admin']], function() {
    /* الصلاحيات */
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.destroy');

    /* اضافة مستخدمين */
    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
     /* المهام */
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('tasks/{task}/review', [TaskController::class, 'review'])->name('tasks.review');
    Route::post('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

     /* المقاولات */
    Route::get('contracting', [ContractingController::class, 'index'])->name('contractings.index');
    Route::get('contracting/create', [ContractingController::class, 'create'])->name('contractings.create');
    Route::post('contracting', [ContractingController::class, 'store'])->name('contractings.store');
    Route::post('contracting/{contracting}/review', [ContractingController::class, 'review'])->name('contractings.review');
    Route::post('contracting/{contracting}', [ContractingController::class, 'update'])->name('contractings.update');
    Route::post('contractings/{contracting}/extend', [ContractingController::class, 'extend'])->name('contractings.extend');

    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');

    });


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    // registeration
    Route::get('register', [LoginController::class, 'show_register_view'])->name('admin.showregister');
    Route::post('register', [LoginController::class, 'register'])->name('admin.register');

});
Route::fallback(function () {
    return redirect()->route('admin.showlogin');
});

