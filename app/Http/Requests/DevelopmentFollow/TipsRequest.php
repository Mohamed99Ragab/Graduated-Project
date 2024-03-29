<?php

namespace App\Http\Requests\DevelopmentFollow;

use App\Http\Traits\HttpResponseJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TipsRequest extends FormRequest
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
            'answers.*.question_id'=>[
            'required','exists:questions,id',
            Rule::unique('results')
                ->where('user_id', Auth::guard('api')->id())
        ],
            'answers.*.status'=>'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'answers.*.question_id.required'=>'معرف السؤال مطلوب',
            'answers.*.question_id.exists'=>'لا يوجد سؤال بهذا المعرف',
            'answers.*.question_id.unique'=>'لا يمكن تحديد السؤال اكثر من مرة يمكنك التعديل على الملاحظة',
            'answers.*.status.required'=>'حالة السؤال مطلوبة',
            'answers.*.status.in'=>'عذرا يجب ان تكون حالة السؤال فقط 1,0',

        ];
    }


}
