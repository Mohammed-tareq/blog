<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManegment
{

    public static function storeImage($request, $post = null , $user = null)
    {
        if ($request->hasFile('images')):
            foreach ($request->images as $image):
                self::deleteImagesForPost($post);
                $path = self::saveImageWithNewName($image,'posts');
                $post->images()->create([
                    'path' => $path,
                ]);
            endforeach;
        endif;
        if($request->hasFile('image')):

            self::deleteImageFormLocal($user->image);
            $image = $request->image;
            $path = self::saveImageWithNewName($image,'users');
            $user->update(['image' => $path]);
        endif;
    }

    public static function deleteImagesForPost($post)
    {
        if ($post->images->count() > 0):
            foreach ($post->images as $image):
               self::deleteImageFormLocal($image->path);
             $image->delete();
            endforeach;
        endif;
    }

    public static function deleteImageFormLocal($image_path):void
    {

        if(File::exists(public_path($image_path))){
            File::delete(public_path($image_path));
        }
    }

    private static function saveImageWithNewName($image,$path)
    {
        $file = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs('uploads/'.$path, $file, ['disk' => 'store']);

    }
}