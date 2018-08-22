<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // // 接管错误异常类
        
        // app('api.exception')->register(function (\Exception $exception) {
        //     $request = Request::capture();
        //     return app('App\Exceptions\Handler')->render($request, $exception);
        // });
        \App\Models\User::observe(\App\Observers\UserObserver::class);

        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if (app()->isLocal()) {
        //     $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        // }

        // \API::error(function (\Symfony\Component\HttpKernel\Exception\HttpException $exception) {
        //     $data = $exception->validator->getMessageBar();
        //     $msg = collect($data)->first();
        //     if(is_array($msg)) {
        //         $msg = $msg[0];
        //     }
        //     return respone()->json(['ResultMessage' => $msg, 'ResultCode' => 400], 500);
        // });
    }
}
