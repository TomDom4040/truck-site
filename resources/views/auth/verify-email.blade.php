<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение Email - Elka Club</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')

    <section class="height_section">
        <div class="wrapper">
            <div class="form_page">
                <form action="{{ url('/verify-email') }}" method="POST">
                    @csrf
                    <h1>Подтверждение Email</h1>
                    <p>На ваш email {{ $email }} отправлен код подтверждения. Введите его ниже:</p>
                    <input type="text" name="code" placeholder="Код подтверждения" required>
                    <div class="error">
                        @if($errors->has('code'))
                            {{ $errors->first('code') }}
                        @endif
                    </div>
                    <button type="submit">Подтвердить</button>
                </form>
            </div>
        </div>
    </section>

    {{-- Подключение футера --}}
    @include('footer')
</body>

</html>
