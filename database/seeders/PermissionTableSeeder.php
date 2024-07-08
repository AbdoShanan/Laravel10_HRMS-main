<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    $permissions = [
      'قائمة الضبط',
      'قائمة شئون الموظفين',
      ' المستخدمين',
      ' الصلاحيات',

      'الضبط العام',
      'تعديل الضبط العام',

      'السنوات المالية',
      'إضافة سنة مالية',
      'تعديل سنة مالية',
      'حذف سنة مالية',
      'عرض الشهور',
      'فتح سنة مالية',

       'إضافة نوع وظيفة',
       'تعديل نوع وظيفة',
       'حذف نوع وظيفة',


      'قائمة الفروع',
      'إضافة فرع',
      'تعديل الفرع',
      'حذف الفرع',

      'انواع الشيفتات',

      'ادارات الموظفين',
      'إضافة إدارة جديده',
      'تعديل الإدارة',
      'حذف الإدارة',
      'بيانات الموظفين',
      'بيانات موظفين الادارة',
      'انواع الاضافي للراتب',
      'انواع الخصم للراتب',
      'انواع البدلات للراتب',

      ' المهام',
      'إضافة مهمة جديدة',
      'إضافة مهمة مقاولات جديدة',

      'وظائف الموظفين',
      'مؤهلات الموظفين',
      'المناسبات الرسمية',
      'انواع ترك العمل',
      'انواع الجنسيات',
      'انواع الديانات',

      ' المقاولات',

      'قائمة الصلاحيات',
      'إضافة صلاحية',
      'حفظ الصلاحية',
      'تعديل الصلاحية',
      'تحديث الصلاحية',
      'حذف الصلاحية',
      
      'قائمة المستخدمين',
      'إضافة مستخدم',
     'تعديل المستخدم',
     'حذف المستخدم',

    ];
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission, 'guard_name' => 'admin']);
    }
}
}