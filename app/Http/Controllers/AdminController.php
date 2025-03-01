<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

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
    public function usersIndex()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Редактирование пользователя
    public function usersEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Удаление пользователя
    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален.');
    }
}