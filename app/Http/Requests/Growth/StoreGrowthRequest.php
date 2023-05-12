<?php

namespace App\Http\Requests\Growth;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;

class StoreGrowthRequest extends FormRequest
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
            'weight'=>'required|numeric|between:2.5,9.6',
            'height'=>'required|numeric|between:49.1,75.7',
            'measure_date'=>'required|date|date_format:Y-m-d'
        ];
    }


    public function messages()
    {
        return [
            'weight.required'=>'يرجي ادخال وزن طفلك بالكيلو جرام',
            'weight.between'=>'هذا الوزن لا يتوافق مع المعدل الطبيعي',
            'height.required'=>'يرجي ادخال طول الطفل بالسنتيمتر',
            'height.between'=>'هذا الطول لا يتوافق مع المعدل الطبيعي',
            'measure_date.required'=>'يرجى تحديد تاريخ قياس الطفل',
        ];
    }
}
