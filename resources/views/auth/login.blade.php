<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
     {{-- Подключение шапки --}}
    @include('header')

   
    <section class="height_section" >
        <div class="wrapper">
            <div class="form_page">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Авторизация</h1>
                <input type="email" name="email" placeholder="Ваш email" required>
                <div class="error" id="emailError"></div>
                <input type="password" name="password" placeholder="Пароль" required>
                <div class="error" id="passwordError"></div>

                <button type="submit">Войти</button>
                <a href="{{ route('register') }}" class="accoutn_link">Нету аккаунта?</a>
            </form>
            </div>
        </div>
    </section>
   


 {{-- Подключение футера --}}
    @include('footer')
</body>

</html>