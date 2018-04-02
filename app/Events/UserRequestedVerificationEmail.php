<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\User;

class UserRequestedVerificationEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The registered user.
     *
     * @var \App\Models\User $User
     */
    public $User;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->User = $user;
    }
}
