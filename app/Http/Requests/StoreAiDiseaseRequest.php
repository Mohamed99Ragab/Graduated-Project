<?php

namespace App\Http\Requests;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class StoreAiDiseaseRequest extends FormRequest
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
            'prediction'=>'required|string|in:0,1',
            'disease'=>'required|string',
            'photo'=>'required|image'
        ];
    }


    public function messages()
    {
        return [
            'prediction.required'=>'يرجى ارسال نتيجية الموديل',
            'prediction.in'=>'يرجي فقط تحديد نتيجة التنباء في حالة ان الشخص مصاب ضع 1 و في حالة انه غير مصاب ضع 0',
            'disease.required'=>'يرجى ارسال اسم المرض',
            'photo.required'=>'يرجى ارفاق صورة الموديل',
            'photo.image'=>'يجب ان يكون الملف المرفق من نوع صورة فقط'
        ];
    }



}
