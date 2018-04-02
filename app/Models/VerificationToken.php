<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
