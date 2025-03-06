<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Метод отображения формы авторизации
    public function showLoginForm()
    {
        return view('auth.login'); // Отображаем страницу логина
    }

    // Метод обработки авторизации
    public function login(Request $request)
    {
        // Логируем входящий запрос для отладки
        Log::info('Login Request', [
            'headers' => $request->headers->all(),
            'is_ajax' => $request->ajax(),
            'expects_json' => $request->expectsJson(),
            'body' => $request->all()
        ]);

        // Валидируем входные данные
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login') // Перенаправляем обратно на форму логина
                ->withErrors($validator) // Передаем ошибки
                ->withInput(); // Сохраняем введенные данные
        }

        // Проверяем пользователя
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('login') // Перенаправляем обратно на форму
                ->withErrors(['email' => 'Неверный email или пароль.']) // Сообщаем о ошибке авторизации
                ->withInput(); // Сохраняем введенные данные
        }

        // Если авторизация успешна, перенаправляем на главную страницу
        return redirect()->intended('/'); 
    }

    // Метод для выхода из системы
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'Вы успешно вышли из системы.');
    }
}
