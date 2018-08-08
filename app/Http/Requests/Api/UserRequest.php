<?php

namespace App\Http\Requests\Api;

// use Illuminate\Foundation\Http\FormRequest;
use Dingo\Api\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|between:3,25',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:6',
                ];
        }
        
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.email' => '请输入邮箱',
            'email.unique' => '邮箱已被占用，请更换邮箱',
            'name.required' => '不能为空',
            'name.string' => '必须为字符',
            'name.between' => '必须为3至25个字符内',
            'password.required' => '密码不能为空',
            'password.string' => '密码必须为字符',
            'password.min' => '密码必须超过6个字符',
        ];
        
    }
}
