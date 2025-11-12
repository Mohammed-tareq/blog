<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class   CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'category_id' =>$this->id,
            'category_name' => $this->name,
            'category_slug' => $this->slug,
            'status' => $this->status(),
            'created_date' => $this->created_at->diffForHumans(),
            'posts' => $this->when($request->is('api/v1/posts'), CategoryPostResource::collection($this->whenLoaded('posts'))),
            'catagory_posts' => $this->when(!$request->is('api/v1/post/show/*'), PostResource::collection($this->whenLoaded('posts')))
        ];


        return $data;
    }

}
