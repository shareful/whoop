<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class BoostCodeProvider extends Model
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_DISABLED = 'Disabled';

    const IMAGE_PATH = 'boost_code_providers';


    protected $table = 'boost_code_providers';

    /**
     * Boost Codes used in this month
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function code_used()
    {
        $from = new Carbon('first day of this month');
        $to = new Carbon('first day of next month');

        return $this->hasMany(UserBoostCode::class, 'boost_code_id')->whereBetween('created_at', [$from, $to]);
    }

    /**
     * total count of used code by this month
     *
     * @return int
     */
    public function getUsedCount()
    {
        return $this->code_used->count();
    }

    /**
     * total credit left for this month
     *
     * @return int
     */
    public function creditLeft()
    {
        $used = $this->getUsedCount();
        if ($this->credits_total > $used) {
            return ($this->credits_total - $used);
        } else {
            return 0;
        }
    }

    /**
     * Automatically Set a credits Left calculated attribute to the model
     *
     * @return int
     */
    public function getCreditsLeftAttribute()
    {
        return $this->creditLeft();
    }

    /**
     * check user already tapped in this month
     *
     * @param App\Models\Admin\User
     * @return boolean
     */
    public function alreadyTapped(User $user)
    {
        $from = new Carbon('first day of this month');
        $to = new Carbon('last day of this month');

        $count = UserBoostCode::where('user_id', $user->id)
                        ->where('boost_code_id', $this->id)
                        ->whereBetween('created_at', [$from, $to])
                        ->count();                

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Tap the whoop button for user
     *
     * @param App\Models\Admin\User
     * @return boolean
     */
    public function tapButton(User $user)
    {
        if ($this->creditLeft() > 0) {
            $tapButton = new UserBoostCode();
            $tapButton->user_id = $user->id;
            $tapButton->boost_code_id = $this->id;
            $tapButton->status = UserBoostCode::STATUS_UNUSED;
            $tapButton->save();

            return true;
        } else {
            throw new Exception('This whoop button exceeds it\'s credit limit.');
        }
    }

}
