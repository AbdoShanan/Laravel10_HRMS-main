<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SalaryDeduction;

class SalaryDeductionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_id' => 'required|exists:admins,id',
            'type' => 'required|string|max:255',
            'basic_salary' => 'required|numeric|min:0',
            'deduction_amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $totalDeductions = SalaryDeduction::where('admin_id', $this->admin_id)->sum('deduction_amount');
                    if ($totalDeductions + $value > $this->basic_salary) {
                        $fail('مجموع الخصومات يتجاوز الراتب الاساسي.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'admin_id.required' => 'حقل اسم الموظف مطلوب.',
            'admin_id.exists' => 'الموظف المحدد غير موجود.',
            'type.required' => 'حقل نوع الخصم مطلوب.',
            'type.string' => 'حقل نوع الخصم يجب أن يكون نصاً.',
            'type.max' => 'حقل نوع الخصم يجب ألا يتجاوز 255 حرفاً.',
            'basic_salary.required' => 'حقل الراتب الاساسي مطلوب.',
            'basic_salary.numeric' => 'حقل الراتب الاساسي يجب أن يكون رقمياً.',
            'basic_salary.min' => 'حقل الراتب الاساسي يجب ألا يقل عن 0.',
            'deduction_amount.required' => 'حقل مبلغ الخصم مطلوب.',
            'deduction_amount.numeric' => 'حقل مبلغ الخصم يجب أن يكون رقمياً.',
            'deduction_amount.min' => 'حقل مبلغ الخصم يجب ألا يقل عن 0.',
        ];
    }
}
