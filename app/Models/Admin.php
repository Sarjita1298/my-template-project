<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins'; // specify if your table is not 'admins', adjust accordingly

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Optionally cast email_verified_at if you have it
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
