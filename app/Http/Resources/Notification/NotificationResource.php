<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'notification_id' => $this->id,
            'notification_type' => $this->type,
            'user_id' => $this->data['user_id'],
            'user_name' => $this->data['user_name'],
            'comment' =>$this->data['comment'],
            'post_id' =>$this->data['post_id'],
            'post_title' =>$this->data['post_title'],
            'link' =>$this->data['link'],
            'created_data' => $this->created_at->diffForHumans(),
            'post_slug' =>$this->data['post_slug'],
            'make_read' => route('post.show',$this->data['post_slug'])."?notifiy=".$this->id,


        ];
    }
}
