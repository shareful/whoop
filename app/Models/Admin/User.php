<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\Role;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    const TYPE_ADMIN = 'Admin';
    const TYPE_TRIAL = 'Trial User';
    const TYPE_VERIFIED = 'Verified User';
    const TYPE_UNVERIFIED = 'Unverified User';

    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'mobile',
        'address',
        'remember_token',
        'email',
        'password',
        'zipcode',
        'city',
        'country',
        'email_token',
        'is_verified',
        'user_type',
        'trial_start_date',
        'trial_end_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_token'
    ];

    /**
     * This user's Home Button
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function home_button()
    {
        //Has one Home Button
        return $this->belongsTo(HomeButton::class);
    }

    /**
     * Deals unlocked by this user.
     */
    public function deals_unlocked()
    {
        return $this->belongsToMany(Deal::class, 'deals_unlocked', 'unlocked_by', 'sub_category_id')->withTimestamps();
    }

    /**
     * Deals this user used.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function used_deals()
    {
        return $this->belongsToMany(Deal::class, 'user_used_deal', 'user_id', 'deal_id')->withPivot('service_provider_id')->withTimestamps();
    }

    /**
     * Invitations this user send
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations_send()
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }

    /**
     * Invitations this user received
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invitations_received()
    {
        return $this->hasMany(Invitation::class, 'accepted_by');
    }

    /**
     * Messages to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    //Todo : Check if this relation is used and remove if unnecessary
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Request for code by post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requestCodeByPost()
    {
        return $this->hasOne(RequestCodeByPost::class);
    }

    /**
     * Boost Codes added by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boost_codes()
    {
        $from = new Carbon('first day of this month');
        $to = new Carbon('last day of this month');
        
        return $this->hasMany(UserBoostCode::class, 'user_id')
                    ->where('status', '=', UserBoostCode::STATUS_UNUSED)
                    ->whereBetween('created_at', [$from, $to]);        
    }


    /**
     * Appointments by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');        
    }




    /**
     * Get User's full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Fetch one pending Invitation of User
     *
     * @return Invitation|null
     */
    public function getInvitationToVerify()
    {
        return Invitation::where([
            ['to_email', '=', $this->email],
            ['status', '=', Invitation::STATUS_PENDING],
        ])->first();
    }

    /**
     * Generate api login token and return it.
     *
     * @return string
     */
    public function generateToken()
    {
        $this->api_token = str_random(60);

        // Update User status for trial mode
        if ($this->user_type == self::TYPE_TRIAL AND $this->getTrialDaysLeft() <= 0) {
            if ($this->is_verified) {
                $this->user_type = self::TYPE_VERIFIED;
            } else {
                $this->user_type = self::TYPE_UNVERIFIED;
            }
        }

        $this->save();

        return $this->api_token;
    }

    /**
     * Get User's Trial days left to expire
     *
     * @return int signed integer
     */
    function getTrialDaysLeft()
    {
        $now = Carbon::now();
        $trial_end_date = Carbon::parse($this->trial_end_date);

        if ($now->gt($trial_end_date)) {
            // return how many days the trial expired.
            return $now->diffInDays($trial_end_date, false);
        } else {
            return $trial_end_date->diffInDays($now);
        }
    }

    /**
     * Get User's Unique Home Button Code
     * return false if Home Button is not found or Locked
     *
     * @return bool|mixed
     */
    public function getHomeButtonUniqueCode()
    {
        if ($this->home_button_status === HomeButton::STATUS_UNLOCKED) {
            if ($this->home_button instanceof HomeButton) {
                return $this->home_button->unique_code;
            }
        }
        return false;
    }

    /**
     * Checks if Users's address matches with Home Button's address
     *
     * @param HomeButton $home_button
     * @return bool
     */
    public function matchesHomeButtonAddress(HomeButton $home_button)
    {
        if ($this->country === $home_button->country
            && $this->city === $home_button->city
            && $this->zipcode === $home_button->zipcode
            && $this->address === $home_button->address) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the Home Button for User
     *
     * @param HomeButton $homeButton
     */
    public function setHomeButton(HomeButton $homeButton)
    {
        $this->home_button_id = $homeButton->id;
        $this->home_button_status = HomeButton::STATUS_UNLOCKED;
    }

    /**
     * Create Home Button for User
     *
     * @return User|boolean
     */
    public function createHomeButton()
    {
        // Create home button if user have address information
        if ($this->city AND $this->zipcode AND $this->country AND $this->address) {
            //Get Home Button
            $homeButton = HomeButton::where('country', $this->country)
                ->where('city', $this->city)
                ->where('zipcode', $this->zipcode)
                ->where('address', $this->address)
                ->first();

            if ($homeButton instanceof HomeButton) {
                if ($homeButton->family->count() <= HomeButton::USER_LIMIT) {
                    //Set Home Button for User
                    $this->setHomeButton($homeButton);
                    $this->home_button_status = HomeButton::STATUS_LOCKED;
                    $this->save();
                    return $this;
                } else {
                    // TODO send message that home button exist with user address and it reached its limit.
                    throw new \Exception('home button exist with user address but it reached its limit of .' . HomeButton::USER_LIMIT . ' users');
                }
            } else {
                $homeButton = new HomeButton();
                $homeButton->city = $this->city;
                $homeButton->country = $this->country;
                $homeButton->zipcode = $this->zipcode;
                $homeButton->address = $this->address;
                $homeButton->unique_code = strtoupper(str_random(8));
                $homeButton->save();

                $this->setHomeButton($homeButton);
                $this->home_button_status = HomeButton::STATUS_LOCKED;
                $this->save();

                return $this;
            }
        } else {
            return false;

            // throw new \Exception('User don\'t have address details yet. Please confirm his city, zipcode, country and address first before requesting for creating home button.');
        }
    }

    /**
     * Create Request Code By Post
     *
     * @return User|boolean
     */
    public function createRequestCodeByPost()
    {
        if (!$this->home_button instanceof HomeButton) {
            if (!$this->createHomeButton()) {
                return false;
            }
        }

        if ($this->requestCodeByPost instanceof RequestCodeByPost) {
            throw new \Exception('This user already requested for code by post.');
        }

        $requestCodeByPost = new RequestCodeByPost();
        $requestCodeByPost->user_id = $this->id;
        $requestCodeByPost->posting_status = RequestCodeByPost::POSTING_STATUS_PENDING;
        $requestCodeByPost->user_action_status = RequestCodeByPost::USER_ACTION_PENDING;
        $requestCodeByPost->save();

        return $this;
    }

    /**
     * Remove your himself from the home button
     *
     * @return User
     */
    public function removeHomeButton()
    {
        $this->home_button_id = 0;
        $this->home_button_status = HomeButton::STATUS_LOCKED;
        $this->save();
        return $this;
    }


}
