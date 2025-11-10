<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'title' => $this->title,
            'slug' => $this->slug,
            'views' => $this->num_of_views,
            'status' => $this->status(),
            'image' =>  ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
