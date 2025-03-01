<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')

    <section class="height_section">
        <div class="wrapper">
            <div class="form_page">
                <form id="loginForm" method="POST">
                    @csrf
                    <h1>Авторизация</h1>
                    <input type="email" name="email" placeholder="Ваш email" required>
                    <div class="error" id="emailError"></div>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <div class="error" id="passwordError"></div>

                    <button type="submit">Войти</button>
                    <a href="{{ route('register') }}" class="accoutn_link">Нету аккаунта?</a>
                    <a href="{{ route('forgot-password') }}" class="accoutn_link">Забыли пароль?</a>
                </form>
            </div>
        </div>
    </section>

    {{-- Подключение футера --}}
    @include('footer')

    <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Отменить стандартное отправление формы

            let formData = $(this).serialize(); // Собрать данные формы

            $.ajax({
                url: '{{ route('login') }}', // Указание маршрута
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Успешная авторизация, редирект на главную страницу
                        window.location.href = '/';
                    } else if (response.errors) {
                        // Выводим ошибки, если есть
                        if (response.errors.email) {
                            $('#emailError').text(response.errors.email[0]);
                        } else {
                            $('#emailError').text('');
                        }
                        if (response.errors.password) {
                            $('#passwordError').text(response.errors.password[0]);
                        } else {
                            $('#passwordError').text('');
                        }
                    }
                },
                error: function() {
                    alert('Произошла ошибка. Пожалуйста, попробуйте позже.');
                }
            });
        });
    });
</script>

</body>

</html>
