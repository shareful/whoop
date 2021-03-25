<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = "sub_categories";

    protected $fillable = ['category_id', 'name', 'image', 'description', 'end_date'];

    protected $appends = ['time_to_expire'];

    /**
     * Deals's Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        //Has one category
        return $this->belongsTo(Category::class);
    }

    /**
     * The deal unlocked for home buttons.
     */
    public function home_buttons()
    {
        return $this->belongsToMany(HomeButton::class, 'deals_unlocked', 'sub_category_id', 'home_button_id')->withPivot('unlocked_by')->withTimestamps();
    }

    /**
     * The Users that unlocked this deal
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'deals_unlocked', 'sub_category_id', 'unlocked_by')->withPivot('home_button_id')->withTimestamps();
    }

    /**
     * Users that used this deal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function used_users()
    {
        return $this->belongsToMany(User::class, 'user_used_deal', 'deal_id', 'user_id')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Providers linked to this Deal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany(ServiceProvider::class, 'sub_category_id', 'id');
    }

    /**
     * Boost Codes Linked to this Deal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boost_codes()
    {
        return $this->hasMany(UserBoostCode::class, 'used_on_deal_id', 'id');
    }

    /**
     * Dynamic attribute calculating the time left to expire
     *
     * @return string
     */
    public function getTimeToExpireAttribute()
    {
        $deal_end_date = new Carbon($this->end_date);
        return $deal_end_date->diffForHumans();
    }

    /**
     * Get boost code used on this deal by a specific user.
     *
     * @param User $user
     * @return Model|null|static
     */
    public function getBoostCodeByUser(User $user)
    {
        return $this->boost_codes()->with('provider')
            ->where('user_id', '=', $user->id)->first();
    }
}
