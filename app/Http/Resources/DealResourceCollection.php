<?php

namespace App\Http\Resources;

use App\Models\Admin\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class DealResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->collection->transform(function ($deal) {
            $user = Auth::guard('api')->user();
            return [
                'id' => $deal->id,
                'name' => $deal->name,
                'image' => getImageUrl($deal->logo, 'category'),
                'description' => $deal->description,
                'end_date' => $deal->end_date,
                'deal_used' => $this->when($user instanceof User,
                    $deal->used_users->contains($user->id))
            ];
        });

        if ($data->count() == 1) {
            // Fixing of sometime collections array sometimes object for when have one element
            return [$data->first()];
        } else {
            return $data->toArray();
        }

    }
}