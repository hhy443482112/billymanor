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

        $credentails['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($credentails)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        // return $this->response->array([
            // 'access_token' => $token,
            // 'token_type' => 'Bearer',
            // 'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
        // ])->setStatusCode(201);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    // 抽出来简单封装
    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
