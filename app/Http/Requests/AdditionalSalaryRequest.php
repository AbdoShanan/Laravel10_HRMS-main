<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalSalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_id' => 'required|exists:admins,id|unique:additional_salaries,admin_id',
            'type' => 'required|string|max:255',
            'basic_salary' => 'required|numeric|min:0',
            'additional_amount' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'admin_id.required' => 'حقل اسم الموظف مطلوب.',
            'admin_id.exists' => 'الموظف المحدد غير موجود.',
            'admin_id.unique' => 'هذا الموظف لديه راتب إضافي مسجل بالفعل.',
            'type.required' => 'حقل نوع الإضافي مطلوب.',
            'basic_salary.required' => 'حقل الراتب الاساسي مطلوب.',
            'basic_salary.numeric' => 'حقل الراتب الاساسي يجب أن يكون رقماً.',
            'basic_salary.min' => 'حقل الراتب الاساسي يجب ألا يكون أقل من 0.',
            'additional_amount.required' => 'حقل المبلغ الإضافي مطلوب.',
            'additional_amount.numeric' => 'حقل المبلغ الإضافي يجب أن يكون رقماً.',
            'additional_amount.min' => 'حقل المبلغ الإضافي يجب ألا يكون أقل من 0.',
        ];
    }
}
