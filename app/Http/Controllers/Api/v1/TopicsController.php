<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Topic;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $this->user()->id;
        $topic->save();

        return response([
            'ResultCode' => 200,
            'ResultMessage' => '发布成功',
            'data' => $topic,
        ], 200);
    }
}
