<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserBoostCodesResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data =  $this->collection->transform(function($provider){
            return [
                'id' => $provider->id,
                'is_city' => $provider->is_city,
                'name' => $provider->name,
                'boost_code' => $provider->boost_code,
                'description' => $provider->description,
                'image' => getImageUrl($provider->image, 'codeprovider'),
                'address' => $provider->address,
                'city' => $provider->city,
                'zipcode' => $provider->zipcode,
                'country' => $provider->country,
            ];
        });

        if ($data->count() == 1) {
            // Fixing of sometime collections array sometimes object for when have one element
            return [$data->first()];
        } else {
            return $data;
        }
    
    }
}