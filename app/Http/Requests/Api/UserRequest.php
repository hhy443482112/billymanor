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
                    // 'name' => 'required|string|between:3,25',
                    // 'phone' => [
                    //     'required',
                    //     'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/',
                    //     'unique:users'
                    // ]
                    // 'email' => 'required|email|unique:users',
                    // 'password' => 'required|string|min:6',
                ];
                break;
            case 'PATCH':
                $userId = \Auth::guard('api')->id();
                return [
                    // 'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,',
                    // 'email' => 'email',
                ];
                break;
        }
        
    }

    public function messages()
    {
        return [
            // 'email.required' => '邮箱不能为空',
            // 'email.email' => '请输入邮箱',
            // 'email.unique' => '邮箱已被占用，请更换邮箱',
            // 'name.required' => '不能为空',
            // 'name.string' => '必须为字符',
            // 'name.between' => '必须为3至25个字符内',
            // 'password.required' => '密码不能为空',
            // 'password.string' => '密码必须为字符',
            // 'password.min' => '密码必须超过6个字符',
        ];
        
    }
}
