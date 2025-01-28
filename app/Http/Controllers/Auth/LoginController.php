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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Попытка авторизации
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            // Если авторизация успешна, редирект на нужную страницу
            return redirect()->intended('/')->with('status', 'Вы успешно авторизованы!');
        }

        // Если авторизация не удалась
        return redirect()->back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->withInput();
    }

    // Метод для выхода из системы
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'Вы успешно вышли из системы.');
    }
}
