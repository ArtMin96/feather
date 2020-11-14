<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'activated',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name'                        => 'string',
        'last_name'                         => 'string',
        'email'                             => 'string',
        'email_verified_at'                 => 'datetime',
        'password'                          => 'string',
        'activated'                         => 'boolean',
        'signup_ip_address'                 => 'string',
        'signup_confirmation_ip_address'    => 'string',
        'signup_sm_ip_address'              => 'string',
        'updated_ip_address'                => 'string',
        'deleted_ip_address'                => 'string',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the profile associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profiles::class);
    }

    /**
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $username
     *
     * @return mixed
     */
    public static function getUserByUsername($username)
    {
        return User::with('profile')->where('username', $username)->firstOrFail();
    }

    /**
     * Profile avatar
     *
     * @return \forxer\Gravatar\Image|string
     */
    public function userAvatar()
    {
        if ($this->profile->avatar) {
            return url('/') . '/storage/' . $this->profile->avatar;
        } else {
            return gravatar()->avatar($this->email);
        }
    }
}
