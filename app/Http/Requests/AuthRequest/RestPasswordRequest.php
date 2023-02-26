<?php

namespace App\Http\Requests\AuthRequest;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class RestPasswordRequest extends FormRequest
{
   use HttpResponseJson;
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
            'code' => 'required|string|exists:reset_code_passwords,code',
            'password' => 'required|string|min:8|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'code.required' => 'يرجي ادخال الكود المرسل على الايميل',
            'code.exists'=>'هذا الكود غير صحيح',
            'password.required' => 'يرجى ادخال كلمة مرور جديدة',
            'password.min' => 'يجب الا يقل الباسورد عن 8 احرف',
            'password.confirmed' => 'يجب ان يتطابق حقل تاكيد الباسورد مع الباسورد',
        ];
    }



}
