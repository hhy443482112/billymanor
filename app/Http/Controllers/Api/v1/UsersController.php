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

        // if ($user->updated_at > app('request')->get('last_updated')) {
        //     throw new Symfony\Component\HttpKernel\Exception\HttpException('User was updated prior to your request.');
        // }

        // $user = new User;
        // $user->email = $request->email;
        // $user->name = $request->name;
        // $user->password = bcrypt($request->password);
        // $user->save();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return response([
            'ResultCode' => 201,
            'ResultMessage' => '注册成功',
            // 'status' => 201,
            'data' => $user,
            'meta' => array([
                'access_token' => \Auth::guard('api')->fromUser($user),
                // 'ResultMessage' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
            ]),
        ], 201);

        // return response()->json(['message' => 'Successfully logged out']);
        // return $this->response->created();
        
        // 注册后返回用户个人信息
        // return $this->response()->item($user, new UserTransformer())
        // // meta 内返回 token
        //     ->setMeta([
        //         'access_token' => \Auth::guard('api')->fromUser($user),
        //         // 'ResultMessage' => \Auth::guard('api')->fromUser($user),
        //         'token_type' => 'Bearer',
        //         'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
        //     ])
        // // 返回状态码
        //     ->setStatusCode(201);
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
