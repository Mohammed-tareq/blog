<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = [
            'post_id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'views' => $this->num_of_views,
            'status' => $this->status(),
            'publisher' => $this->whenLoaded('admin') || $this->whenLoaded('user')
                ? ($this->user_id === null ?
                    AdminResource::make($this->admin)
                    : UserResource::make($this->user))

                : $this->when($request->is('api/v1/category/*'),
                    $this->user_id === null
                        ? AdminResource::make($this->admin)
                        : UserResource::make($this->user)
                ),


            'image' => ImageResource::collection($this->images),
            'comments' => new CommentCollection($this->whenLoaded('comments')),
            'comments_count' => $this->whenCounted('comments'),

            $this->mergeWhen($request->is('api/v1/post/show/*'), [
                'tags' => $this->tags,
                'description' => $this->description,
                'comment_able' => $this->comment_able(),
                'created_date' => $this->created_at->diffForHumans(),
                'category' => CategoryResource::make($this->whenLoaded('category')),
                'comments' => new CommentCollection($this->whenLoaded('comments')),
            ])
        ];


        return $data;
    }
}
