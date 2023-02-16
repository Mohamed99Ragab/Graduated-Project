<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;

class LoginReguest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'fcm_token'=>'required'
        ];
    }


    public function messages()
    {
        return [
            'email.required'=>'يرجي ادخال الايميل',
            'email.email'=>'يجب ان يكون هذا الحقل من نوع ايميل',
            'email.exists'=>'هذا الايميل غير موجود الرجاء عمل حساب اولا',
            'password.required'=>'يرجى ادخال كلمة المرور اولا',
            'fcm_token'=>'هذا الحقل مطلوب'

        ];
    }


}
