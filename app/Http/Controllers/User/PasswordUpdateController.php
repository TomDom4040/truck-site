<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordUpdateController extends Controller
{
    public function update(Request $request)
    {
        // Валидация данных
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Проверка текущего пароля
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Неверный текущий пароль']);
        }

        // Обновление пароля
        $user = User::where('id', Auth::id())->first();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profile.settings')->with('success', 'Пароль успешно обновлен');
    }
}
