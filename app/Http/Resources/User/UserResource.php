<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status(),
            'created_date' => $this->created_at->diffForHumans(),
            $this->mergeWhen($request->is('api/v1/account/user'), [
                'email' => $this->email,
                'user_name' => $this->user_name,
                'phone' => $this->phone,
                'country' => $this->country,
                'city' => $this->city,
                'street' => $this->street,
                'image' => $this->image,
            ])
        ];
    }
}
