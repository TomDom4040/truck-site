<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as LaravelAuthenticatable;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use LaravelAuthenticatable, CanResetPasswordTrait, Notifiable;

    protected $fillable = [
        'email', 'password', 'email_verified_at', 'verification_code', 'profile_id', 'avatar', 'description', 'phone', 'social_links'
    ];
    
    public function getIsAdminAttribute()
    {
        return $this->attributes['is_admin'];
    }
    protected $attributes = [
        'email_verified' => false,
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->profile_id) {
                $user->profile_id = (string) Str::uuid();
            }
        });
    }
}
