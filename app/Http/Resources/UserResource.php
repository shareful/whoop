<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\Admin\User;
use Carbon\Carbon;

class UserResource extends Resource
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
            'user_type' => $this->user_type,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'photo' => getImageUrl($this->photo, 'user'),
            'email' => $this->email,
            'mobile' => $this->mobile,
            'country' => $this->country,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'address' => $this->address,
            'is_verified' => $this->is_verified,
            'home_button_status' => $this->home_button_status,
            'email_verified' => $this->email_verified,
            'api_token' => $this->api_token,
            'trial_start_date' => $this->trial_start_date,
            'trial_end_date' => $this->trial_end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($data['user_type'] == User::TYPE_TRIAL) {
            $now = Carbon::now();
            $trial_end_date = Carbon::parse($data['trial_end_date']);
            if ($now->gt($trial_end_date)) {
                // return how many days the trial expired.
                $data['trial_days_left'] = $now->diffInDays($trial_end_date, false);
            } else {
                $data['trial_days_left'] = $trial_end_date->diffInDays($now);
            }
        }

        return $data;
    }
}
