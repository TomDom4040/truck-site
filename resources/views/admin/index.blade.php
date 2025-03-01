<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Elka Club</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="dashboard">
        <h1>Админ-панель</h1>
        <div class="dashboard-cards">
            <div class="card">
                <h2>Пользователи</h2>
                <p>Управление пользователями системы</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <div class="card">
                <h2>Заказы</h2>
                <p>Управление заказами</p>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <div class="card">
                <h2>Товары</h2>
                <p>Управление товарами</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <!-- Добавьте другие карточки -->
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>