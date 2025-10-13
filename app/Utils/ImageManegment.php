<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManegment
{
    public static function storeImage($request, $post)
    {
        if ($request->hasFile('images')):
            foreach ($request->images as $image):

                $file = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/posts', $file, ['disk' => 'store']);

                $post->images()->create([
                    'path' => $path,
                ]);
            endforeach;
        endif;
    }

    public static function deleteImage($post)
    {
        if ($post->images->count() > 0):
            foreach ($post->images as $image):
                if(File::exists(public_path($image->path))){
                    File::delete(public_path($image->path));
                }
            endforeach;
        endif;
    }
}