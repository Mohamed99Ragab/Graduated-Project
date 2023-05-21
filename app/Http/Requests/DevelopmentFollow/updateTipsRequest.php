<?php

namespace App\Http\Requests\DevelopmentFollow;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class updateTipsRequest extends FormRequest
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
            'answers.*.question_id'=>'required|exists:results,question_id',
            'answers.*.status'=>'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.question_id.required'=>'معرف السؤال مطلوب',
            'answers.*.question_id.exists'=>'معرف السؤال غير موجود',
            'answers.*.status.required'=>'حالة السؤال مطلوبة',
            'answers.*.status.in'=>'عذرا يجب ان تكون حالة السؤال فقط 1,0',

        ];
    }
}
