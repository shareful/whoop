<?php

namespace App\Jobs;

use App\Models\Admin\Invitation;
use App\Models\Admin\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\EmailInvitation;

class SendInvitationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Current User
     * @var User
     */
    protected $user;

    /**
     * Address to send Mail to
     * @var mixed
     */
    protected $to_mail;

    /**
     * Home Button Unique ID
     * @var string
     */
    protected $home_button_unique_code;

    /**
     * SendInvitationMail constructor.
     * Create a new job instance.
     * @param User $user
     * @param string $to_mail
     * @param string $home_button_unique_code
     */
    public function __construct(User $user, $to_mail, $home_button_unique_code)
    {
        $this->user = $user;
        $this->to_mail = $to_mail;
        $this->home_button_unique_code = $home_button_unique_code;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $email = new EmailInvitation($this->user, $this->home_button_unique_code);
        Mail::to($this->to_mail)
            ->send($email);
    }
}
