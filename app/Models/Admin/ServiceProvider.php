<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $table = "service_providers";

    /**
     * ServiceProvider's Deal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
