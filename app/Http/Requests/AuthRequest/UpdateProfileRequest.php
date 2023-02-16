<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|between:2,100|regex:/^[\p{Arabic} ]+$/u',
            'email' => 'required|string|email|unique:users,email,'.Auth::guard('api')->id(),
            'photo' => 'mimes:jpg,png,jpeg|image',
            'gender' => 'required|string|in:ذكر,انثى',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'password' => 'string|min:8',

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
            'password.min' => 'يجب الا يقل الباسورد عن 8 احرف',
            'gender.required' => 'يرجي تحديد النوع',
            'gender.in' => 'يجب ان يكون النوع ذكر او انثى',
            'birth_date.required' => 'يرجى تحديد تاريخ ميلاد الطفل',
            'birth_date.date_format' => 'يجب ان يكون تاريخ الميلاد بهذا الصيغة 12-02-2005',
            'photo.mimes' => 'نوع الصورة المرفقة يجب ان تكون بهذا الصيغ ,jpeg,png,jpg',
            'photo.image' => 'يجب ان يكون الملف المرفق صورة وليس شيء اخر',


        ];
    }
}
