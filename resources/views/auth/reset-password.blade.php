<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
     {{-- Подключение шапки --}}
    @include('header')

   
    <section class="height_section" >
        <div class="wrapper">
            <div class="form_page">
                <form action="{{ url('/reset-password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" placeholder="Ваш email" required>
                    <input type="password" name="password" placeholder="Новый пароль" required>
                    <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                    <button type="submit">Сменить пароль</button>
                </form>
            </div>
        </div>
    </section>
   


 {{-- Подключение футера --}}
    @include('footer')
</body>

</html>