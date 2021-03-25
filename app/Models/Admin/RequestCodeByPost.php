<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RequestCodeByPost extends Model
{
	// @var const posting code status
	// pending mean letter not posted yet
    const POSTING_STATUS_PENDING = 'pending';
    // posted mean letter has been posted to the user address
    const POSTING_STATUS_POSTED = 'posted';

    // @var const user action status
    // pending mean user not received code yet
    const USER_ACTION_PENDING = 'pending';
    // success mean user received code and enter this and unlocked their button
    const USER_ACTION_SUCCESS = 'success';

    /**
     * Requested By User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requested_by()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Validate code and mark as verified user
     *
     * @return boolean
     */
    public function validateAndAcceptCode(string $code, User $user)
    {
        if (!$this->requested_by instanceof User) {
            throw new \Exception('Request not found the targated user.'); 
        }

        if ($this->requested_by->id != $user->id) {
            throw new \Exception('Requested by User and the User Provided doesn\'t match.'); 
        }


        if (!$this->requested_by->home_button instanceof HomeButton) {
            throw new \Exception('Home button not found for this user.'); 
        }

        if ($this->requested_by->home_button->unique_code != $code) {
            return false;
        }

        $this->user_action_status = RequestCodeByPost::USER_ACTION_SUCCESS;
        $this->save();

        $this->requested_by->home_button_status = HomeButton::STATUS_UNLOCKED;
        $this->requested_by->is_verified = 1;
        $this->requested_by = User::TYPE_VERIFIED;
        $this->requested_by->save();

        return true;
    }
}
