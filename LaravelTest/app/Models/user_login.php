<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Illuminate\Foundation\Auth\User as Authenticatable;  

class user_login extends Authenticatable
{
  
    use HasFactory,Billable;
    protected $table = "users";
    protected $fillable = [
        'Username',
        'Email',
        'Password',
        'Name',
        'type',
        'image'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
