<?php

namespace App\Http\Controllers;

use App\Models\Ad;  // Используем правильную модель Ad
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Получаем текущего авторизованного пользователя
        $ads = Ad::with('user', 'category', 'city')->latest()->get(); // Получаем объявления
    
        return view('index', compact('user', 'ads')); // Передаем и объявления, и данные о пользователе
    }


    // Метод для отображения страницы авторизации
    public function auth()
    {
        return view('auth');
    }

    // Метод для отображения страницы регистрации
    public function registration()
    {
        return view('registration');
    }
}
