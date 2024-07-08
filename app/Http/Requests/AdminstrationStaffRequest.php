<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminstrationStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'admin_id' => [
                'required',
                'exists:admins,id',
                'unique:adminstration_staff_details,admin_id',
            ],
            'department' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'admin_id.required' => 'حقل اسم الموظف مطلوب.',
            'admin_id.exists' => 'الموظف المحدد غير موجود.',
            'admin_id.unique' => 'الموظف المحدد موجود بالفعل ',
            'department.required' => 'حقل الإدارة التابع لها مطلوب.',
            'department.string' => 'حقل الإدارة يجب أن يكون نصاً.',
            'department.max' => 'حقل الإدارة يجب ألا يتجاوز 255 حرفاً.',
        ];
    }
}
