<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Elka Club</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Подключение иконок Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="dashboard">
        <h1>Админ-панель</h1>
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h2>Пользователи</h2>
                <p>Управление пользователями системы</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <h2>Настройки объявлений</h2>
                <p>Управление настройками объявлений</p>
                <a href="{{ route('admin.ad-settings.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <div class="card">
                <div class="card-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h2>Объявления</h2>
                <p>Управление объявлениями</p>
                <a href="{{ route('admin.ads.index') }}" class="btn btn-primary">Перейти</a>
            </div>
            <!-- Добавьте другие карточки -->
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>