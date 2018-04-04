<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int            $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $username account username
 * @property string $password bcrypt hashed password
 * @property string $email account email address
 * @property string|null $mobile users mobile number
 * @property int $activated status of account. 0: not activated, 1:activated
 * @property int $verified_email indicates whether email address has been verified
 * @property int $verified_mobile indicates whether mobile number has been verified
 * @property int $isReal indicates test accounts. 0: test, 1: real
 * @property string|null $remember_token
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\VerificationToken $verificationToken
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsReal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVerifiedEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVerifiedMobile($value)
 * @mixin \Eloquent
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

}
