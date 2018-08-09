<?php

namespace App\Http\Controllers\Api\v1;


use App\Models\User;
// use Auth;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;


class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $phone = $request->phone;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            
        ]);

        // return $this->response->created();
        // 注册后返回用户个人信息
        return $this->response->item($user, new UserTransformer())
        // meta 内返回 token
            ->setMeta([
                'access.token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() *60
            ])
        // 返回状态码
            ->setStatusCode(201);
    }

    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email']);

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
