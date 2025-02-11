<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Генерация уникального 6-значного кода подтверждения
        do {
            $verificationCode = mt_rand(100000, 999999);
        } while (User::where('verification_code', $verificationCode)->exists());

        // Генерация уникального 5-6 значного profile_id
        do {
            $userId = mt_rand(10000, 999999); // 5-6 значное число
        } while (User::where('profile_id', $userId)->exists());

        // Создание пользователя
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'verification_code' => $verificationCode,
            'profile_id' => $userId,
        ]);

        // Отправка письма с кодом подтверждения
        Mail::to($user->email)->send(new VerificationMail($verificationCode));

        session(['email' => $user->email]);

        return redirect()->route('verify.email');
    }

    public function showVerifyEmailForm()
    {
        $email = session('email');

        if (!$email) {
            return redirect()->route('register');
        }

        return view('auth.verify-email', ['email' => $email]);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6', // Гарантируем, что ввод будет 6 цифр
        ]);

        $email = session('email');

        if (!$email) {
            return redirect()->route('register')->withErrors(['email' => 'Email не найден в сессии']);
        }

        $user = User::where('email', $email)
                    ->where('verification_code', $request->input('code'))
                    ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['code' => 'Неверный код подтверждения']);
        }

        // Подтверждение email
        $user->update([
            'email_verified_at' => now(),
            'email_verified' => true,
            'verification_code' => null, // Очищаем код после подтверждения
        ]);

        Auth::login($user);

        return redirect('/')->with('status', 'Почта успешно подтверждена!');
    }
}
