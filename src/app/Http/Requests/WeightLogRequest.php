<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:1', 'max:300'],
            'calories' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'exercise_time' => ['nullable', 'date_format:H:i'],
            'exercise_content' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付は必須です。',
            'date.date' => '正しい日付形式で入力してください。',

            'weight.required' => '体重は必須です。',
            'weight.numeric' => '体重は数値で入力してください。',
            'weight.min' => '体重は1kg以上で入力してください。',
            'weight.max' => '体重は300kg以下で入力してください。',

            'calories.integer' => '摂取カロリーは整数で入力してください。',
            'calories.min' => '摂取カロリーは0以上で入力してください。',
            'calories.max' => '摂取カロリーは10000以下で入力してください。',

            'exercise_time.date_format' => '運動時間は「時:分」形式で入力してください。',

            'exercise_content.max' => '運動内容は1000文字以内で入力してください。',
        ];
    }
}
