<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // ホワイトリスト方式で「name」、「email」、「password」、「profile」のカラム更新を許可
    protected $fillable = [
        'name', 'email', 'password', 'profile',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() { //1対多の「多」側なので複数形
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
