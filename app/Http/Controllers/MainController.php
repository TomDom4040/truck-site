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
        
        // Фильтруем объявления по статусу 'approved' и сортируем по approved_at
        $ads = Ad::with('user', 'category', 'city')
                 ->where('status', 'approved') // Только одобренные объявления
                 ->orderBy('approved_at', 'desc') // Сортировка по дате одобрения (сначала новые)
                 ->get(); // Получаем все объявления с пользователями и другими связанными данными
    
        return view('index', compact('ads')); // Передаем объявления в представление
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