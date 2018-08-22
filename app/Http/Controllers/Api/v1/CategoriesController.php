<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;


class CategoriesController extends Controller
{
    public function index()
    {
        // return $this->response->collection(Category::all());
        return response([
            'ResultCode' => 200,
            'ResultMessage' => '成功获取分类列表',
            'data' => Category::all()
        ], 200);
    }
}
