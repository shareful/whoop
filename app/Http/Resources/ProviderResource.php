<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProviderResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'deal_id' => $this->sub_category_id,
            'brand_name' => $this->brand_name,
            'strap_line' => $this->strap_line,
            'description' => $this->description,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'street' => $this->street,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'state' => $this->state,
            'country' => $this->country,
            'web_url' => $this->web_url,
            'logo' => getImageUrl($this->logo, 'provider'),
            'color' => $this->color,
            // 'commission_rate' => $this->commission_rate,
            'whoop_credit' => $this->whoop_credit,
            'video' => getImageUrl($this->video, 'provider'), // video and image saved in same directory , so same funtion will for video
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
