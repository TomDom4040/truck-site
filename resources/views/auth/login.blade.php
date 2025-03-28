<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')

    <section class="height_section">
        <div class="wrapper">
            <div class="form_page">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Авторизация</h1>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Ваш email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" required>
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit">Войти</button>
                    <a href="{{ route('register') }}" class="accoutn_link">Нету аккаунта?</a>
                    <a href="{{ route('forgot-password') }}" class="accoutn_link">Забыли пароль?</a>
                </form>
            </div>
        </div>
    </section>

    {{-- Подключение футера --}}
    @include('footer')
</body>

</html>
