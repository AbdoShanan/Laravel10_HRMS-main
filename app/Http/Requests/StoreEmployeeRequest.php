<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'emp_name' => 'required|string|max:255',
            'emp_gender' => 'required|in:1,2',
            'branch_id' => 'required|exists:branches,id',
            'Qualifications_id' => 'required|string|max:255',
            'Qualifications_year' => 'required|string',
            'graduation_estimate' => 'nullable|in:1,2,3,4,5',
            'Graduation_specialization' => 'nullable|string|max:255',
            'brith_date' => 'nullable|date',
            'emp_national_idenity' => 'required|string|max:50|unique:employees,emp_national_idenity',
            'emp_identityPlace' => 'nullable|string|max:255',
            'emp_end_identityIDate' => 'nullable|date',
            'blood_group_id' => 'nullable|string|max:255',
            'religion_id' => 'nullable|string|max:255',
            'emp_lang_id' => 'nullable|string|max:255',
            'emp_email' => 'required|email|unique:employees,emp_email',
            'country_id' => 'nullable|string|max:255',
            'governorate_id' => 'nullable|string|max:255',
            'city_id' => 'nullable|string|max:255',
            'emp_home_tel' => 'nullable|string|max:20',
            'emp_work_tel' => 'nullable|string|max:20',
            'emp_military_id' => 'required|integer',
            'emp_military_date_from' => 'nullable|date',
            'emp_military_date_to' => 'nullable|date',
            'emp_military_wepon' => 'nullable|string|max:255',
            'exemption_date' => 'nullable|date',
            'exemption_reason' => 'nullable|string|max:255',
            'postponement_reason' => 'nullable|string|max:255',
            'Date_resignation' => 'nullable|date',
            'resignation_cause' => 'nullable|string|max:255',
            'does_has_Driving_License' => 'nullable|in:1,2',
            'driving_License_degree' => 'nullable|string|max:150',
            'driving_license_types_id' => 'nullable|string|max:150',
            'has_Relatives' => 'required|in:1,2',
            'Relatives_details' => 'nullable|string|max:150',
            'notes' => 'nullable|string|max:150',

            //second form
            'emp_start_date' => 'required|date',
            'Functiona_status' => 'nullable|in:1,0',
            'emp_Departments_code' => 'required|string',
            'emp_jobs_id' => 'required|max:255',
            'does_has_ateendance' => 'nullable|in:1,0',
            'is_has_fixced_shift' => 'nullable|in:1,0',
            'shift_type_id' => 'nullable|string',
            'daily_work_hour' => 'nullable|string',
            'emp_sal' => 'required|string',
            'MotivationType' => 'required|in:0,1,2',
            'Motivation' => 'required_if:MotivationType,1',
            'isSocialnsurance' => 'required|in:0,1',
            'Socialnsurancecutmonthely' => 'required_if:isSocialnsurance,1',
            'SocialnsuranceNumber' => 'nullable|string',
            'ismedicalinsurance' => 'nullable|in:0,1',
            'medicalinsurancecutmonthely' => 'nullable|numeric',
            'medicalinsuranceNumber' => 'nullable|string',
            'sal_cach_or_visa' => 'required|in:1,2',
            'is_active_for_Vaccation' => 'required|in:0,1',
            'urgent_person_details' => 'nullable|string',
            'staies_address' => 'nullable|string|max:255',
            'children_number' => 'nullable|numeric',
            'emp_social_status_id' => 'nullable|string',
            'is_Disabilities_processes' => 'required|in:1,2',
            'Disabilities_processes' => 'nullable|string|max:255',
            'emp_nationality_id' => 'required|string|max:255',

            // third form
            'emp_cafel' => 'nullable|string|max:255',
            'emp_pasport_no' => 'nullable|string|max:255',
            'emp_pasport_from' => 'nullable|string|max:255',
            'emp_pasport_exp' => 'nullable|date',
            'emp_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'emp_CV' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'emp_Basic_stay_com' => 'nullable|string',
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
            'emp_name.required' => 'اسم الموظف مطلوب.',
            'emp_name.string' => 'اسم الموظف يجب أن يكون نصًا.',
            'emp_name.max' => 'اسم الموظف يجب ألا يتجاوز 255 حرفًا.',
            'emp_gender.required' => 'الجنس مطلوب.',
            'emp_gender.in' => 'الجنس يجب أن يكون 1 (ذكر) أو 2 (أنثى).',
            'branch_id.required' => 'الفرع مطلوب.',
            'branch_id.exists' => 'الفرع المحدد غير صالح.',
            'Qualifications_id.required' => 'رقم المؤهلات مطلوب.',
            'Qualifications_id.string' => 'رقم المؤهلات يجب أن يكون نصًا.',
            'Qualifications_id.max' => 'رقم المؤهلات يجب ألا يتجاوز 255 حرفًا.',
            'Qualifications_year.required' => 'سنة المؤهلات مطلوبة.',
            'Qualifications_year.string' => 'سنة المؤهلات يجب أن تكون نصًا.',
            'graduation_estimate.in' => 'التقدير يجب أن يكون أحد القيم: 1، 2، 3، 4، 5.',
            'Graduation_specialization.string' => 'التخصص يجب أن يكون نصًا.',
            'Graduation_specialization.max' => 'التخصص يجب ألا يتجاوز 255 حرفًا.',
            'brith_date.date' => 'تاريخ الميلاد يجب أن يكون تاريخًا صالحًا.',
            'emp_national_idenity.string' => 'رقم الهوية الوطنية يجب أن يكون نصًا.',
            'emp_national_idenity.max' => 'رقم الهوية الوطنية يجب ألا يتجاوز 50 حرفًا.',
            'emp_national_idenity.unique' => 'هذا الموظف موجود بالفعل.',
            'emp_identityPlace.string' => 'مكان الهوية يجب أن يكون نصًا.',
            'emp_identityPlace.max' => 'مكان الهوية يجب ألا يتجاوز 255 حرفًا.',
            'emp_end_identityIDate.date' => 'تاريخ انتهاء الهوية يجب أن يكون تاريخًا صالحًا.',
            'blood_group_id.string' => 'فصيلة الدم يجب أن تكون نصًا.',
            'blood_group_id.max' => 'فصيلة الدم يجب ألا يتجاوز 255 حرفًا.',
            'religion_id.string' => 'الديانة يجب أن تكون نصًا.',
            'religion_id.max' => 'الديانة يجب ألا يتجاوز 255 حرفًا.',
            'emp_lang_id.string' => 'اللغة يجب أن تكون نصًا.',
            'emp_lang_id.max' => 'اللغة يجب ألا يتجاوز 255 حرفًا.',
            'emp_email.required' => 'البريد الإلكتروني مطلوب.',
            'emp_email.email' => 'البريد الإلكتروني يجب أن يكون عنوان بريد إلكتروني صالح.',
            'emp_email.unique' => 'البريد الإلكتروني مستخدم من قبل  .',
            'country_id.string' => 'الدولة يجب أن تكون نصًا.',
            'country_id.max' => 'الدولة يجب ألا يتجاوز 255 حرفًا.',
            'governorate_id.string' => 'المحافظة يجب أن تكون نصًا.',
            'governorate_id.max' => 'المحافظة يجب ألا يتجاوز 255 حرفًا.',
            'city_id.string' => 'المدينة يجب أن تكون نصًا.',
            'city_id.max' => 'المدينة يجب ألا يتجاوز 255 حرفًا.',
            'emp_home_tel.string' => 'الهاتف المنزلي يجب أن يكون نصًا.',
            'emp_home_tel.max' => 'الهاتف المنزلي يجب ألا يتجاوز 20 حرفًا.',
            'emp_work_tel.string' => 'هاتف العمل يجب أن يكون نصًا.',
            'emp_work_tel.max' => 'هاتف العمل يجب ألا يتجاوز 20 حرفًا.',
            'emp_military_id.required' => 'رقم الهوية العسكرية مطلوب.',
            'emp_military_id.integer' => 'رقم الهوية العسكرية يجب أن يكون عددًا صحيحًا.',
            'emp_military_date_from.date' => 'تاريخ بدء الخدمة العسكرية يجب أن يكون تاريخًا صالحًا.',
            'emp_military_date_to.date' => 'تاريخ انتهاء الخدمة العسكرية يجب أن يكون تاريخًا صالحًا.',
            'emp_military_wepon.string' => 'السلاح يجب أن يكون نصًا.',
            'emp_military_wepon.max' => 'السلاح يجب ألا يتجاوز 255 حرفًا.',
            'exemption_date.date' => 'تاريخ الإعفاء يجب أن يكون تاريخًا صالحًا.',
            'exemption_reason.string' => 'سبب الإعفاء يجب أن يكون نصًا.',
            'exemption_reason.max' => 'سبب الإعفاء يجب ألا يتجاوز 255 حرفًا.',
            'postponement_reason.string' => 'سبب التأجيل يجب أن يكون نصًا.',
            'postponement_reason.max' => 'سبب التأجيل يجب ألا يتجاوز 255 حرفًا.',
            'Date_resignation.date' => 'تاريخ الاستقالة يجب أن يكون تاريخًا صالحًا.',
            'resignation_cause.string' => 'سبب الاستقالة يجب أن يكون نصًا.',
            'resignation_cause.max' => 'سبب الاستقالة يجب ألا يتجاوز 255 حرفًا.',
            'does_has_Driving_License.in' => 'الرخصة يجب أن تكون 1 (نعم) أو 2 (لا).',
            'driving_License_degree.string' => 'درجة الرخصة يجب أن تكون نصًا.',
            'driving_License_degree.max' => 'درجة الرخصة يجب ألا يتجاوز 150 حرفًا.',
            'driving_license_types_id.string' => 'نوع الرخصة يجب أن يكون نصًا.',
            'driving_license_types_id.max' => 'نوع الرخصة يجب ألا يتجاوز 150 حرفًا.',
            'has_Relatives.required' => 'حقل الأقارب مطلوب.',
            'has_Relatives.in' => 'حقل الأقارب يجب أن يكون 1 (نعم) أو 2 (لا).',
            'Relatives_details.string' => 'تفاصيل الأقارب يجب أن تكون نصًا.',
            'Relatives_details.max' => 'تفاصيل الأقارب يجب ألا يتجاوز 150 حرفًا.',
            'notes.string' => 'الملاحظات يجب أن تكون نصًا.',
            'notes.max' => 'الملاحظات يجب ألا يتجاوز 150 حرفًا.',

            //second form
            'emp_start_date.required' => 'تاريخ بدء العمل مطلوب.',
            'emp_start_date.date' => 'تاريخ بدء العمل يجب أن يكون تاريخًا صالحًا.',
            'Functiona_status.in' => 'حالة الوظيفة يجب أن تكون 1 (نشط) أو 0 (غير نشط).',
            'emp_Departments_code.required' => 'كود القسم مطلوب.',
            'emp_Departments_code.string' => 'كود القسم يجب أن يكون نصًا.',
            'emp_jobs_id.required' => 'معرف الوظيفة مطلوب.',
            'emp_jobs_id.max' => 'معرف الوظيفة يجب ألا يتجاوز 255 حرفًا.',
            'does_has_ateendance.in' => 'حقل الحضور يجب أن يكون 1 (نعم) أو 0 (لا).',
            'is_has_fixced_shift.in' => 'حقل الشفت الثابت يجب أن يكون 1 (نعم) أو 0 (لا).',
            'shift_type_id.string' => 'نوع الشفت يجب أن يكون نصًا.',
            'daily_work_hour.string' => 'ساعات العمل اليومية يجب أن تكون نصًا.',
            'emp_sal.required' => 'الراتب مطلوب.',
            'emp_sal.string' => 'الراتب يجب أن يكون نصًا.',
            'MotivationType.required' => 'نوع الحافز مطلوب.',
            'MotivationType.in' => 'نوع الحافز يجب أن يكون 0، 1 أو 2.',
            'Motivation.required_if' => 'الحافز مطلوب عند تحديد نوع الحافز.',
            'isSocialnsurance.required' => 'حالة التأمين الاجتماعي مطلوبة.',
            'isSocialnsurance.in' => 'حالة التأمين الاجتماعي يجب أن تكون 0 (لا) أو 1 (نعم).',
            'Socialnsurancecutmonthely.required_if' => 'الخصم الشهري للتأمين الاجتماعي مطلوب عند تحديد حالة التأمين الاجتماعي.',
            'SocialnsuranceNumber.string' => 'رقم التأمين الاجتماعي يجب أن يكون نصًا.',
            'ismedicalinsurance.in' => 'حالة التأمين الصحي يجب أن تكون 0 (لا) أو 1 (نعم).',
            'medicalinsurancecutmonthely.numeric' => 'الخصم الشهري للتأمين الصحي يجب أن يكون عددًا.',
            'medicalinsuranceNumber.string' => 'رقم التأمين الصحي يجب أن يكون نصًا.',
            'sal_cach_or_visa.required' => 'طريقة صرف الراتب مطلوبة.',
            'sal_cach_or_visa.in' => 'طريقة صرف الراتب يجب أن تكون 1 (نقدًا) أو 2 (بطاقة).',
            'is_active_for_Vaccation.required' => 'حالة الإجازة مطلوبة.',
            'is_active_for_Vaccation.in' => 'حالة الإجازة يجب أن تكون 0 (لا) أو 1 (نعم).',
            'urgent_person_details.string' => 'تفاصيل الشخص المعني يجب أن تكون نصًا.',
            'staies_address.string' => 'عنوان الإقامة يجب أن يكون نصًا.',
            'staies_address.max' => 'عنوان الإقامة يجب ألا يتجاوز 255 حرفًا.',
            'children_number.numeric' => 'عدد الأطفال يجب أن يكون عددًا.',
            'emp_social_status_id.string' => 'الحالة الاجتماعية يجب أن تكون نصًا.',
            'is_Disabilities_processes.required' => 'حالة المعالجة مطلوبة.',
            'is_Disabilities_processes.in' => 'حالة المعالجة يجب أن تكون 1 (نعم) أو 2 (لا).',
            'Disabilities_processes.string' => 'تفاصيل المعالجة يجب أن تكون نصًا.',
            'Disabilities_processes.max' => 'تفاصيل المعالجة يجب ألا يتجاوز 255 حرفًا.',
            'emp_nationality_id.required' => 'الجنسية مطلوبة.',
            'emp_nationality_id.string' => 'الجنسية يجب أن تكون نصًا.',
            'emp_nationality_id.max' => 'الجنسية يجب ألا يتجاوز 255 حرفًا.',

            // third form
            'emp_cafel.string' => 'الكفيل يجب أن يكون نصًا.',
            'emp_cafel.max' => 'الكفيل يجب ألا يتجاوز 255 حرفًا.',
            'emp_pasport_no.string' => 'رقم جواز السفر يجب أن يكون نصًا.',
            'emp_pasport_no.max' => 'رقم جواز السفر يجب ألا يتجاوز 255 حرفًا.',
            'emp_pasport_from.string' => 'مصدر جواز السفر يجب أن يكون نصًا.',
            'emp_pasport_from.max' => 'مصدر جواز السفر يجب ألا يتجاوز 255 حرفًا.',
            'emp_pasport_exp.date' => 'تاريخ انتهاء جواز السفر يجب أن يكون تاريخًا صالحًا.',
            'emp_photo.image' => 'حقل الصورة يجب أن يكون صورة صالحة.',
            'emp_photo.max' => 'حقل الصورة يجب ألا يتجاوز 2 ميجابايت.',
            'emp_CV.mimes' => 'حقل السيرة الذاتية يجب أن يكون ملف PDF أو Word.',
            'emp_CV.max' => 'حقل السيرة الذاتية يجب ألا يتجاوز 2 ميجابايت.',
            'emp_Basic_stay_com.string' => 'الإقامة الأساسية يجب أن تكون نصًا.',
        ];
    }
}
