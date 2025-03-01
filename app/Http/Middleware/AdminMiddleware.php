<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Проверка, авторизован ли пользователь и является ли он администратором
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'У вас нет доступа к админ-панели.');
        }

        return $next($request);
    }
}