<?php

namespace App\Http\Requests\AuthRequest;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompleteProfileRequest extends FormRequest
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

            'gender' => 'required|string|in:ذكر,انثى',
            'birth_date' => 'required|date|date_format:Y-m-d|before:tomorrow',

        ];
    }


    public function messages()
    {
        return [

            'gender.required' => 'يرجي تحديد النوع',
            'gender.in' => 'يجب ان يكون النوع ذكر او انثى',
            'birth_date.required' => 'يرجى تحديد تاريخ ميلاد الطفل',
            'birth_date.date_format' => 'يجب ان يكون تاريخ الميلاد بهذا الصيغة 12-02-2005',
            'birth_date.before' => 'عذرا لا يمكن ان يكون تاريخ الميلاد قبل اليوم',



        ];
    }




}
