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
    <section class="height_section">
        <div class="wrapper">
            <div class="form_page">
                <form action="{{ url('/register')}}" method="POST" id="registration">
                    @csrf
                    <h1>Регистрация</h1>
                    <input type="email" name="email" placeholder="Ваш email" required>
                    <div class="error" id="emailError"></div>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <div class="error" id="passwordError"></div>
                    <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                    <div class="error" id="passwordConfirmationError"></div>

                    <div class="checkbox_box">
                        <input type="checkbox" name="accept_terms"  id="accept_terms" required>
                        <p>Принимаю условия <br> <a href="">пользовательского соглашения</a></p>
                    </div>
                    <button type="submit">Зарегистрироваться</button>
                    <a href="{{ url('/login') }}"" class="accoutn_link">Уже есть аккаунт?</a>
                </form>
            </div>
        </div>
    </section>


  {{-- Подключение футера --}}
    @include('footer')
</body>

</html>