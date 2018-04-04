<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VerificationToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $created_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerificationToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerificationToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerificationToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerificationToken whereUserId($value)
 * @mixin \Eloquent
 */
class VerificationToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'token'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
