<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAiDiseaseRequest extends FormRequest
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
            'prediction'=>'required|string',
            'photo'=>'required|mimes:jpg,png,jpeg'
        ];
    }


    public function messages()
    {
        return [
            'prediction.required'=>'يرجى ارسال نتيجية الموديل',
            'photo.required'=>'يرجى ارفاق صورة الموديل',
            'photo.mimes'=>' jpg,png,jpeg يجب ان يكون نوع الصورة المرفقة بهذة الصيغ فقط'
        ];
    }


    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
