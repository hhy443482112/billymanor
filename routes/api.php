<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api = app('Dingo\Api\Routing\Router');

// $api->version('v1', function($api) {
//     $api->get('version', function() {
//         return response('this is version v1');
//     });
// });
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api\v1',
    // 'middleware' => 'serializer:array'
    'middleware' => ['serializer:array', 'bindings']
], function($api) {
    // $api->group([
    //     'middleware' => 'api.throttle',
    // ], function($api) {
        // 游客可以访问的接口
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户的信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑用户个人信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
        });
    // });            
});