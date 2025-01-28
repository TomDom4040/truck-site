<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as LaravelAuthenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Str;

class User extends Model implements AuthenticatableContract
{
    use LaravelAuthenticatable;

    // Указываем, что поле profile_id может быть массово заполняемым
    protected $fillable = [
        'email', 'password', 'email_verified_at', 'verification_code', 'profile_id',
    ];
    
    // Значения по умолчанию
    protected $attributes = [
        'email_verified' => false, // Почта по умолчанию не подтверждена
    ];

    // Генерация profile_id перед созданием пользователя
    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->profile_id) {
                $user->profile_id = (string) Str::uuid(); // Генерация уникального идентификатора
            }
        });
    }
}
