<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int            $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'verified_email', 'verified_mobile',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function verificationToken()
    {
        return $this->hasOne(VerificationToken::class, 'user_id', 'id');
    }

    public function hasVerifiedEmail()
    {
        if($this->verified_email == 1){
            return true;
        }

        return false;
    }

    public static function byEmail($email)
    {
        return self::where('email', $email);
    }
}
