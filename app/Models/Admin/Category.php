<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name', 'image', 'description', 'is_national'];

    /**
     * Deals linked to this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    /**
     * Deals linked to this category - Backend
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deal()
    {
        return $this->hasMany('App\Models\Admin\Deal', 'category_id', 'id');
    }
}