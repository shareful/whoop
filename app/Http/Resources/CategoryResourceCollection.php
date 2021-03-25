<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->collection->transform(function ($category) {
            $tmp = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => getImageUrl($category->image, 'category'),
                'description' => $category->description,
                // 'created_at' => $category->created_at,
                // 'updated_at' => $category->updated_at,
            ];
            if (isset($category->locked_deals_count)) {
                $tmp['locked_deals_count'] = $category->locked_deals_count;
            }
            if (isset($category->unlocked_deals_count)) {
                $tmp['unlocked_deals_count'] = $category->unlocked_deals_count;
            }
            return $tmp;
        });

        if ($data->count() == 1) {
            // Fixing of sometime collections array sometimes object for when have one element
            return [$data->first()];
        } else {
            return $data;
        }

    }
}