<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllowanceSalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_id' => [
                'required',
                'exists:admins,id',
                'unique:allowance_salaries,admin_id',
            ],
            'type' => 'required|string|max:255',
            'basic_salary' => 'required|numeric',
            'allowance_amount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'admin_id.required' => 'حقل اسم الموظف مطلوب.',
            'admin_id.exists' => 'الموظف المحدد غير موجود.',
            'admin_id.unique' => 'هذا الموظف لديه بدل راتب بالفعل.',
            'type.required' => 'حقل نوع البدلات مطلوب.',
            'type.string' => 'حقل نوع البدلات يجب أن يكون نصاً.',
            'type.max' => 'حقل نوع البدلات يجب ألا يتجاوز 255 حرفاً.',
            'basic_salary.required' => 'حقل الراتب الأساسي مطلوب.',
            'basic_salary.numeric' => 'حقل الراتب الأساسي يجب أن يكون رقماً.',
            'allowance_amount.required' => 'حقل مبلغ البدل مطلوب.',
            'allowance_amount.numeric' => 'حقل مبلغ البدل يجب أن يكون رقماً.',
        ];
    }
}
