<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMailSettings;

class EmailUpdateController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        // Валидация данных
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'email_password' => 'required',
        ]);
    
        // Проверка текущего пароля пользователя
        if (!Hash::check($request->email_password, Auth::user()->password)) {
            return response()->json(['error' => 'Неверный текущий пароль'], 400);
        }
    
        // Генерация кода подтверждения
        $verificationCode = mt_rand(100000, 999999);
    
        // Отправка кода на новый email
        Mail::to($request->new_email)->send(new VerificationMailSettings($verificationCode));
    
        // Сохраняем код и новый email в сессии
        session(['verification_code' => $verificationCode, 'new_email' => $request->new_email]);
    
        // Возвращаем успешный ответ в формате JSON
        return response()->json(['success' => 'Код отправлен на новый email']);
    }

    public function update(Request $request)
    {
        // Валидация кода подтверждения
        $request->validate([
            'verification_code' => 'required|digits:6',
        ]);

        // Проверка правильности кода
        if ($request->verification_code != session('verification_code')) {
            return redirect()->back()->withErrors(['verification_code' => 'Неверный код подтверждения']);
        }

        // Обновление email пользователя
        $user = User::where('id', Auth::id())->first();
        $user->update([
            'email' => session('new_email')
        ]);

        // Очистка сессии
        session()->forget(['verification_code', 'new_email']);

        return redirect()->route('profile.settings')->with('success', 'Email успешно обновлен');
    }
}
