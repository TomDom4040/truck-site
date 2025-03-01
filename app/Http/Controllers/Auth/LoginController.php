<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Метод отображения формы авторизации
    public function showLoginForm()
    {
        return view('auth/login');
    }

    // Метод обработки авторизации
    public function login(Request $request)
{
    // Валидация данных
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    }

    // Попытка авторизации
    if (Auth::attempt([
        'email' => $request->input('email'),
        'password' => $request->input('password')
    ])) {
        // Если авторизация успешна, перенаправляем пользователя
        return redirect()->intended('/'); // Замените '/dashboard' на нужный вам маршрут
    }

    // Если авторизация не удалась
    return response()->json(['errors' => ['email' => ['Неверный email или пароль.']]]);
}


    // Метод для выхода из системы
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'Вы успешно вышли из системы.');
    }
}
