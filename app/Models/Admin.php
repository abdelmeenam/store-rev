<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'super_admin', 'status',
    ];

    // each user has only one profile
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
            ->withDefault([             //if you don't make default values you will face [Attempt to read property "first_name" on null] problem when you edit profile
                'first_name' => 'default name',
                'last_name' => 'default last name'
            ]);
    }
}
