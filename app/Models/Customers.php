<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
     use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'gender',
        'email',
        'phone',
        'password',
        'profile_photo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
