<?php

namespace App\Models;

use App\Notifications\resetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Create full name accessor

    public function getFullNameAttribute() {
        return strtoupper(substr($this->firstName, 0, 1)) . "." . $this->lastName;
    }

    public function sendPasswordResetNotification($token)
    {
        $url = 'http://127.0.0.1:8000/reset_password?token=' . $token . '&email=' . $this->email;
        $this->notify(new resetPassword($url));
    }
}
