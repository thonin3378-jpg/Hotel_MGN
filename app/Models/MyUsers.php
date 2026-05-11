<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyUsers extends Authenticatable
{
    use HasFactory;

    protected $table = 'myusers';

    protected $fillable = [
        'staff_id',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function staff()
    {
        return $this->belongsTo(Staffs::class, 'staff_id');
    }
}
