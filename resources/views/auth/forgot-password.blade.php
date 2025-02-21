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
            <form action="{{ url('/forgot-password') }}" method="POST">
                @csrf
                <h1>Восстановление пароля</h1>
                <input type="email" name="email" placeholder="Ваш email" required>
                <button type="submit">Отправить ссылку</button>
            </form>
            </div>
            </div>
        </div>
    </section>
    {{-- Всплывающее уведомление --}}
    @if(session('status'))
        <div class="notification" id="notification">
            {{ session('status') }}
        </div>
    @endif
    <script>
        // Показываем уведомление, если оно есть
        @if(session('status'))
            document.getElementById('notification').style.display = 'block';
            setTimeout(function() {
                document.getElementById('notification').style.display = 'none';
            }, 5000); // Убираем уведомление через 5 секунд
        @endif
    </script>


 {{-- Подключение футера --}}
    @include('footer')
</body>

</html>