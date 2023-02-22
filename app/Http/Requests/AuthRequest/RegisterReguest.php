<?php

namespace App\Http\Requests\AuthRequest;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class RegisterReguest extends FormRequest
{
    use HttpResponseJson;

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
            'name' => 'required|string|between:2,100|regex:/^[\p{Arabic} ]+$/u',
            'email' => 'required|string|email|unique:users,email',
            'photo' => 'mimes:jpg,png,jpeg|image',
            'gender' => 'required|string|in:ذكر,انثى',
            'birth_date' => 'required|date|date_format:Y-m-d|before:tomorrow',
            'password' => 'required|string|confirmed|min:8',
            'fcm_token' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال الاسم',
            'name.regex' => 'يرجى ادخال الاسم بالعربي',
            'email.required' => 'يرجي ادخال الايميل',
            'email.email' => 'يجب ان يكون هذا الحقل من نوع ايميل',
            'email.unique' => 'هذا الايميل مستخدم من قبل',
            'password.required' => 'يرجى ادخال كلمة المرور اولا',
            'password.min' => 'يجب الا يقل الباسورد عن 8 احرف',
            'password.confirmed' => 'يجب ان يتطابق حقل تاكيد الباسورد مع الباسورد',
            'gender.required' => 'يرجي تحديد النوع',
            'gender.in' => 'يجب ان يكون النوع ذكر او انثى',
            'birth_date.required' => 'يرجى تحديد تاريخ ميلاد الطفل',
            'birth_date.date_format' => 'يجب ان يكون تاريخ الميلاد بهذا الصيغة 12-02-2005',
            'birth_date.before' => 'عذرا لا يمكن ان يكون تاريخ الميلاد قبل اليوم',
            'photo.mimes' => 'نوع الصورة المرفقة يجب ان تكون بهذا الصيغ ,jpeg,png,jpg',
            'photo.image' => 'يجب ان يكون الملف المرفق صورة وليس شيء اخر',
            'fcm_token' => 'هذا الحقل مطلوب'

        ];
    }


    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }







}
