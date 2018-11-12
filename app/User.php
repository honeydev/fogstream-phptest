<?php

declare(strict_types=1);

namespace News;

use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return Carbon
     */
    public function getBirthday(): Carbon
    {
        return Carbon::parse($this->birthday);
    }

    /**
     * @return Avatar
     */
    public function avatar(): Avatar
    {
        $avatarRelation = $this->hasOne('News\Avatar', 'user_id');
        if ($avatarRelation->get()->isEmpty()) {
            return User::where('email', 'default')->first()->avatar();
        }
        return $avatarRelation->first();
    }
}
