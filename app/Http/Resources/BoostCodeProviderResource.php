<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BoostCodeProviderResource extends Resource
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
            'name' => $this->name,
            'unique_id' => $this->unique_id,
            // 'boost_code' => $this->boost_code,
            'description' => $this->description,
            'image' => getImageUrl($this->image, 'codeprovider'),
            'address' => $this->address,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'country' => $this->country,
            'credits_total' => $this->credits_total,
            'credit_left' => $this->creditLeft(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
