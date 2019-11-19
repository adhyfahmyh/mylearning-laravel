<?php

<<<<<<< HEAD
namespace MyLearning;
=======
namespace PLearning;
>>>>>>> 83057d45ae102081508fb236bfd2d6dfdfb3d56c

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
        'username', 'firstname','lastname', 'about', 'email', 'contact', 'birthday', 'link', 'password',
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

    public function contents(){
<<<<<<< HEAD
        // return $this->hasMany(['MyLearning\Post', 'MyLearning\Contents']);
        return $this->hasMany('MyLearning\Contents');
    }

    public function ratings(){
        return $this->hasMany('MyLearning\Ratings');
=======
        // return $this->hasMany(['PLearning\Post', 'PLearning\Contents']);
        return $this->hasMany('PLearning\Contents');
    }

    public function ratings(){
        return $this->hasMany('PLearning\Ratings');
>>>>>>> 83057d45ae102081508fb236bfd2d6dfdfb3d56c
    }
}
