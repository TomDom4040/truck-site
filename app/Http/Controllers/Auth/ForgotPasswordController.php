<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        // Валидация email
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
    
        // Отправка ссылки для сброса пароля
        $status = Password::sendResetLink($request->only('email'));
    
        // Проверка успешности отправки ссылки для сброса пароля
        if ($status === Password::RESET_LINK_SENT) {
            // Добавление успешного сообщения в сессию
            Session::flash('status', 'Письмо с инструкцией отправлено!');
            return back();
        } else {
            // В случае ошибки, добавляем ошибку в сессию
            return back()->withErrors(['email' => 'Ошибка отправки письма']);
        }
    }
}
