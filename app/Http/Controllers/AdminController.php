<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Главная страница админ-панели
    public function index()
    {
        // Проверка, авторизован ли пользователь и является ли он администратором
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'У вас нет доступа к админ-панели.');
        }

        // Логика для отображения админ-панели
        return view('admin.index');
    }

    // Страница пользователей
    public function usersIndex(Request $request)
{
    // Получаем строку для поиска
    $search = $request->input('search');
    
    // Если строка поиска есть, фильтруем пользователей
    $users = User::when($search, function($query) use ($search) {
        return $query->where('email', 'like', '%' . $search . '%');
    })->paginate(10); // Пагинация пользователей

    return view('admin.users.index', compact('users'));
}

    // Редактирование пользователя по profile_id
    public function usersEdit($profile_id)
    {
        // Ищем пользователя по profile_id
        $user = User::where('profile_id', $profile_id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    // Обновление пользователя
    public function usersUpdate(Request $request, $profile_id)
{
    $user = User::where('profile_id', $profile_id)->firstOrFail();
    
    // Логируем входные данные для отладки
    Log::info('Updating user', ['request' => $request->all()]);
    
    // Валидируем данные
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'social_links' => 'nullable|string',
        'is_admin' => 'nullable|boolean', // Роль админа
    ]);
    
    // Логируем данные после валидации
    Log::info('Validated user data', ['validated' => $validated]);
    
    // Обновляем данные пользователя
    $user->update($validated);
    
    // Обработка аватара
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
        $user->save();
    }

    // Обновление роли админа
    $user->is_admin = $request->has('is_admin') ? 1 : 0;
    $user->save();
    
    return redirect()->route('admin.users.edit', $user->profile_id)->with('success', 'Данные пользователя обновлены.');
}

    // Удаление пользователя
    public function usersDestroy($profile_id)
    {
        $user = User::where('profile_id', $profile_id)->firstOrFail();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален.');
    }
    public function search(Request $request)
{
    $email = $request->input('email');
    
    // Поиск пользователей по почте
    $users = User::where('email', 'like', '%' . $email . '%')->get();

    return view('admin.dashboard', compact('users'));
}
}
