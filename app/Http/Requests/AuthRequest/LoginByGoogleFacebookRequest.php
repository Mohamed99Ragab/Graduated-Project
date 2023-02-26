<?php

namespace App\Http\Requests\AuthRequest;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class LoginByGoogleFacebookRequest extends FormRequest
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
            'oauth_token'=>'required|string',
            'provider'=>'required|string|in:google,facebook',
            'fcm_token'=>'required'
        ];
    }



    public function messages()
    {
        return [
            'oauth_token.required'=>'يرجى ادخال oauth token',
            'provider.required'=>'يجب تحديد نوع التسجيل',
            'provider.in'=>'يجب ان يكون نوع التسجيل عن طريق google , facebook فقط',
            'fcm_token.required'=>'fcm token يرجي ادخال '
        ];
    }




}
