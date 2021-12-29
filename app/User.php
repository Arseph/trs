<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'username',
        'password',
        'level',
        'fname',
        'mname',
        'lname',
        'title',
        'contact',
        'email',
        'accrediation_no',
        'accrediation_validity',
        'license_no',
        'prefix',
        'picture',
        'designation',
        'status',
        'last_login',
        'login_status',
        'void'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
