<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileEditController extends Controller
{
    // Отображение страницы редактирования профиля
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile-edit', compact('user'));
    }

    // Обновление данных профиля
    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Валидация всех необходимых полей
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'telegram' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,heic,heif|max:2048', // Валидация для аватара, включая вебп и айфоновские форматы
        ]);
    
        // Обработка аватара
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар, если есть
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }
    
            // Сохраняем новый аватар
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        } else {
            // Если аватар не был загружен, оставляем путь к дефолтной картинке
            $validated['avatar'] = $user->avatar ?? 'img/user_avatar.webp';
        }
    
        // Сохранение данных пользователя
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => $validated['name'],
                'description' => $validated['about'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'social_links' => json_encode(array_filter([
                    'telegram' => $validated['telegram'],
                    'instagram' => $validated['instagram'],
                    'facebook' => $validated['facebook'],
                    'tiktok' => $validated['tiktok'],
                ])),
                'avatar' => $validated['avatar'], // Сохраняем путь к аватару
            ]);
    
        return redirect()->route('user.profile', ['profile_id' => $user->profile_id])
            ->with('success', 'Профиль успешно обновлен!');
    }
}