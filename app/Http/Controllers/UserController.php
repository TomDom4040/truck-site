<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Метод для отображения страницы профиля
    public function showProfile($profile_id)
    {
        // Пытаемся найти пользователя по profile_id
        $user = User::where('profile_id', $profile_id)->firstOrFail();

        // Передаем данные пользователя на страницу
        return view('user.profile', compact('user'));
    }
}
