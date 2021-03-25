<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /**
     * Constants for Status
     */
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';

    public $table = "invitation";

    /**
     * The User who send this Invitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function send_user()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * The User who received this Invitation (After Accepting the Invitation)
     * returns null before Invitation is Accepted and the User Id is saved to `accepted_by`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function received_user()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    /**
     * Home Button this Invitation is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home_button()
    {
        return $this->belongsTo(HomeButton::class);
    }

    /**
     * Populate data for a new Invitation
     *
     * @param $sender
     * @param $to_email
     */
    public function newInvitation(User $sender, $to_email)
    {
        $this->home_button_id = $sender->home_button->id;
        $this->invited_by = $sender->id;
        $this->to_email = $to_email;
        $this->status = Invitation::STATUS_PENDING;
        $this->accepted_by = 0;
    }

    /**
     * Accept this Invitation
     *
     * @param User $user
     * @return  User
     * @throws \Exception
     */
    public function acceptInvitation(User $user)
    {
        if ($this->to_email === $user->email) {
            $this->accepted_by = $user->id;
            $this->status = self::STATUS_ACCEPTED;
            $this->save();

            //Set Home Button for User
            $user->setHomeButton($this->home_button);
            $user->user_type = User::TYPE_VERIFIED;
            $user->save();
            return $user;
        } else {
            throw new \Exception('User Email Mismatch.');
        }
    }
}
