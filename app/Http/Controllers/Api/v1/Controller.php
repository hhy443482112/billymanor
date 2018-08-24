<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

    // public function success($data = [])
    // {
    //     return response()->json([
    //         'status'  => true,
    //         'ResultCode'    => 200,
    //         'ResultMessage' => config('errorcode.code')[200],
    //         'data'    => $data,
    //     ]);
    // }
    
}