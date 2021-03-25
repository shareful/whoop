<?php

namespace App\Http\Resources;

use App\Models\Admin\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class DealResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::guard('api')->user();

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'image' => getImageUrl($this->image, 'category'),
            'description' => $this->description,
            'deal_used' => $this->when($user instanceof User,
                $this->used_users->contains($user->id)),
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
