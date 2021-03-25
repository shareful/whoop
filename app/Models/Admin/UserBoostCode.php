<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class UserBoostCode extends Model
{
    const STATUS_USED = 'Used';
    const STATUS_UNUSED = 'Unused';


    protected $table = 'user_boost_codes';

    /**
     * The boost code provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(BoostCodeProvider::class, 'boost_code_id');
    }

    /**
     * The boost code provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Deal Linked to this boost code
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deal()
    {
        return $this->belongsTo(Deal::class, 'used_on_deal_id', 'id');
    }

    public function useOnDeal(Deal $deal)
    {
        if ($this->status !== self::STATUS_USED) {
            $this->used_on_deal_id = $deal->id;
            $this->status = self::STATUS_USED;
            $this->date_used = new Carbon();
            $this->save();
        } else {
            throw new Exception('UserBoostCode::useOnDeal function called on a used Boost Code Entity.');
        }
    }
}
