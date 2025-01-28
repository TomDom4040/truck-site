<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    // Метод для отображения главной страницы
    public function index()
    {
        $user = Auth::user(); // Получаем авторизованного пользователя

        // Передаем данные пользователя на страницу
        return view('index', compact('user'));
    }
    public function auth()
    {
        return view('auth');
    }
    public function registration()
    {
        return view('registration');
    }
   
   
}
