<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  [
            'id' => $this->id,
            'name' => $this->name,
            'image' => getImageUrl($this->image, 'category'),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        if (isset($this->locked_deals_count)) {
            $data['locked_deals_count'] = $this->locked_deals_count;
        }
        if (isset($this->unlocked_deals_count)) {
            $data['unlocked_deals_count'] = $this->unlocked_deals_count;
        }

        return $data;
    }
}
