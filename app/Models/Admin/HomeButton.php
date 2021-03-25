<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeButton extends Model
{
    const STATUS_LOCKED = 'locked';
    const STATUS_UNLOCKED = 'unlocked';
    const USER_LIMIT = 8;

    public $table = "home_button";

    /**
     * This Home Button's Linked Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function family()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Invitations send for this Home Button
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    /**
     * Deals unlocked for this home buttons.
     */
    public function unlocked_deals()
    {
        return $this->belongsToMany(Deal::class, 'deals_unlocked', 'home_button_id', 'sub_category_id')->withPivot('unlocked_by')->withTimestamps();
    }

    /**
     * This Home Button's address data
     *
     * @return array
     */
    public function getFullAddressData()
    {
        return array(
            'country' => $this->country,
            'city' => $this->city,
            'zipcode' => $this->zipcode,
            'address' => $this->address
        );
    }

    /**
     * Get the User count linked to this Home Button
     *
     * @return int
     */
    public function getUserCount()
    {
        return $this->family->count();
    }
}
