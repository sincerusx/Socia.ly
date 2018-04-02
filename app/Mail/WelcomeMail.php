<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    const SUBJECT = 'Welcome to SociApp';

    /**
     * User model
     *
     * @var \App\Models\User $User
     */
    protected $User;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->User = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*->attach('/path/to/file', [
                          'as' => 'name.pdf',
                          'mime' => 'application/pdf',
                  ]);*/

        return $this->subject(self::SUBJECT)
                    ->from('do-not-respond@sociapp.com')
                    ->markdown('emails.auth.welcome')
                    ->with([
                            'username' => $this->User->username,
                            'email'    => $this->User->email,
                            'token'    => $this->User->verificationToken['token'],
                    ]);

    }
}
