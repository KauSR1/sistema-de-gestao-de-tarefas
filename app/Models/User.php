<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';

    protected $casts = [
    'active'     => 'boolean',
    'last_login' => 'datetime',
    'password'   => 'hashed',
    ];

    protected $fillable = ['name','username','email','password','active'];
    protected $hidden = ['password','remember_token'];

}
