<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Image;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Handlers\ImageUploadHandler;
// use App\Transformers\ImageTransformer;
// use App\Http\Requests\Api\ImageRequest;

class ImagesController extends Controller
{
    public function store(Request $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = $this->user();

        $size = $request->type == 'avatar' ? 362 : 1024;
        $result = $uploader->save($request->image, str_plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return response([
            'ResultCode' => 200,
            'ResultMessage' => '上传成功',
            'data' => $image,
        ], 200);
    }
}
