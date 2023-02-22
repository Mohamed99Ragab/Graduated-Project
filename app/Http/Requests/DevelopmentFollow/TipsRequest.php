<?php

namespace App\Http\Requests\DevelopmentFollow;

use Illuminate\Foundation\Http\FormRequest;

class TipsRequest extends FormRequest
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
            'answers.*.question_id'=>'required',
            'answers.*.status'=>'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.question_id.required'=>'معرف السؤال مطلوب',
            'answers.*.status.required'=>'حالة السؤال مطلوبة',
            'answers.*.status.in'=>'عذرا يجب ان تكون حالة السؤال فقط 1,0',

        ];
    }

    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
