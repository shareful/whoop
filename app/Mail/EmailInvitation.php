<?php

namespace App\Mail;

use App\Models\Admin\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Current User
     * @var User
     */
    public $user;
    /**
     * Home button code
     * @var integer
     */
    public $home_button_code;

    /**
     * EmailInvitation constructor.
     * Create a new message instance.
     * @param $user
     * @param $home_button_code
     */
    public function __construct($user, $home_button_code)
    {
        $this->user = $user;
        $this->home_button_code = $home_button_code;
    }

    /**
     * Build the message.     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Whoop! Me Happy Invitation')
            ->view('email.email_invitation');
    }
}
