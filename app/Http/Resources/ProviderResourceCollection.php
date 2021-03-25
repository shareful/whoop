<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProviderResourceCollection extends ResourceCollection
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
                'brand_name' => $provider->brand_name,
                'strap_line' => $provider->strap_line,
                'description' => $provider->description,
                'logo' => getImageUrl($provider->logo, 'provider'),
                'color' => $provider->color,
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