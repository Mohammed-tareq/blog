<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name' => $this->site_name,
            'logo' => $this->logo,
            'favicon' => $this->favicon,
            'phone' => $this->phone,
            'email' => $this->email,
            'city' => $this->city,
            'street' => $this->street,
            'country' => $this->country,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube,
            'desc_for_site' => $this->desc_for_site,

        ];
    }
}
