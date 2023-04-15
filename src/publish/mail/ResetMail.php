<?php

namespace App\Mail;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * User information for email.
     *
     * @var [array]
     */
    public $user;

    /**
     * Email layout.
     *
     * @var [string]
     */
    public $layout;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $layout)
    {
        $this->user = $user;
        $this->layout = $layout;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = $this->generateResetLink();

        return $this->from([
            'email' => $this->user->email,
        ])->subject('Password Reset')
            ->markdown('nogor.emails.'.$this->layout)
            ->with('user', $this->user)
             ->with('link', $link);
    }

   /**
     * Generate a password reset link for the user and store it in the database.
     *
     * @return string The password reset link.
     */
    public function generateResetLink()
    {
        $token = Str::uuid()->toString();

        $emailExist = DB::table('password_reset_tokens')
            ->where('email', $this->user->email)
            ->first();

        if ($emailExist) {
            DB::table('password_reset_tokens')
            ->where('email', $this->user->email)
            ->delete();
        }

        DB::table('password_reset_tokens')->insert([
            'email' => $this->user->email,
            'token' => $token,
        ]);

        $verification = DB::table('password_reset_tokens')
            ->where('email', $this->user->email)
            ->first();

        $link = url('/app/password-reset').'?uid='.$token.'&token='.$verification->token;

        return $link;
    }
}
