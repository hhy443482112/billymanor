<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentails['email'] = $username :
            $credentails['phone'] = $username;

        // if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        //     $credentails['email'] = $username;
        // } else {
        //     $credentails['phone'] = $username;
        // }

        $credentails['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($credentails)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
            
            // return response()->json([
            //     'ResultMessage' => '用户名或密码错误',
            //     'ResultCode' => 401
            // ], 401);
        }

        // return $this->response->array([
            // 'access_token' => $token,
            // 'token_type' => 'Bearer',
            // 'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
        // ])->setStatusCode(201);

        // return $this->respondWithToken($token)->setStatusCode(201);
        return response([
            'ResultCode' => 200,
            'ResultMessage' => '登录成功',
            'meta' => array(
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            )], 200);
    }

    public function update()
    {
        $token = Auth::guard('api')->refresh();
        // return $this->respondWithToken($token);
        return response([
            'ResultCode' => 200,
            'ResultMessage' => '刷新成功',
            'meta' => array(
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            )], 200);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        // return $this->response->noContent();
        return response([
            'ResultCode' => 200,
            'ResultMessage' => '删除成功',
        ], 200);
    }

    // // 抽出来简单封装
    // public function respondWithToken($token)
    // {
    //     return $this->response->array([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //         'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
    //     ]);
    // }
}
