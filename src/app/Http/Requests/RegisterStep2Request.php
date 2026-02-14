<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'weight' => [
                'required',
                'numeric',
                'between:0,999.9',
                'regex:/^\d{1,3}(\.\d{1})?$/'
            ],
            'target_weight' => [
                'required',
                'numeric',
                'between:0,999.9',
                'regex:/^\d{1,3}(\.\d{1})?$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => '体重を入力してください',
            'weight.numeric'  => '数字で入力してください',
            'weight.between'  => '999.9以下で入力してください',
            'weight.regex'    => '整数3桁まで、小数は1桁で入力してください',

            'target_weight.required' => '体重を入力してください',
            'target_weight.numeric'  => '数字で入力してください',
            'target_weight.between'  => '999.9以下で入力してください',
            'target_weight.regex'    => '整数3桁まで、小数は1桁で入力してください',
        ];
    }
}
