<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $base_url = URL::to('/');
        $path = 'public/image_uploads';
        $image = $request->file('image');
        $name_image = $image->hashName();
        $image->storeAs($path, $name_image);

        $data = [
            'path' => $path,
            'url' => $base_url . '/storage/image_uploads/' . $name_image,
        ];

        $save_data_image = Image::create($data);
        return new ImageResource(200, 'success', $save_data_image);
    }
}
