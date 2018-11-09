<?php

declare(strict_types=1);

namespace News;

use Carbon\Carbon;
use http\Exception\RuntimeException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getBirthday(): Carbon
    {
        return Carbon::parse($this->birthday_date);
    }

    public function avatar(): Avatar
    {
        $avatarRelation = $this->hasOne('News\Avatar', 'user_id');
        if ($avatarRelation->get()->isEmpty()) {
           return User::where('email', 'default')->first()->avatar();
        }
        return $avatarRelation->first();
    }

}
