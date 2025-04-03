<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:18',
            'phone'=>'nullable|regex:/^([0-9\s\-\+\(\)]+)$/',
        ];
    }
    /**
     * 自定義驗證錯誤訊息
     */
    public function messages(): array
    {
        return [
            'name.required' => '姓名欄位必填',
            'name.max' => '姓名不得超過255個字元',
            'email.required' => '電子郵件欄位必填',
            'email.email' => '請輸入有效的電子郵件地址',
            'age.required' => '年齡欄位必填',
            'age.integer' => '年齡必須為整數',
            'age.min' => '年齡必須至少為18歲',
            'phone.regex' =>'電話格式錯誤'
        ];
    }
}
