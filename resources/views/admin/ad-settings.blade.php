<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Стили остаются прежними */
        .alert {
            margin-top: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .form-control {
            border-radius: 0.375rem;
            padding: 10px;
        }

        .btn {
            border-radius: 0.375rem;
            padding: 10px 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .tab-content {
            margin-top: 30px;
        }

        .tab-pane {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link {
            border-radius: 0.375rem 0.375rem 0 0;
            padding: 10px 20px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .tab-pane table {
            width: 100%;
            border-collapse: collapse;
        }

        .tab-pane table th, .tab-pane table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .tab-pane table th {
            background-color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
        }

        .nav-pills {
            margin-bottom: 20px;
        }

        .nav-pills .nav-link {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="container">
        <h1>Настройки объявлений</h1>

        {{-- Сообщения об успехе --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabs -->
        <ul class="nav nav-pills" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->input('active_tab') == 'cities' ? 'active' : '' }}" id="cities-tab" data-bs-toggle="pill" href="#cities" role="tab" aria-controls="cities" aria-selected="true">Города</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->input('active_tab') == 'categories' ? 'active' : '' }}" id="categories-tab" data-bs-toggle="pill" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Категории</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->input('active_tab') == 'packages' ? 'active' : '' }}" id="packages-tab" data-bs-toggle="pill" href="#packages" role="tab" aria-controls="packages" aria-selected="false">Пакеты и соцсети</a>
            </li>
        </ul>

        <div class="tab-content" id="settingsTabsContent">
            {{-- Города --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'cities' ? 'show active' : '' }}" id="cities" role="tabpanel" aria-labelledby="cities-tab">
                <h2>Города</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->price }}</td>
                                <td>
                                    <form action="{{ route('admin.ad-settings.updateCity', $city->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $city->name }}">
                                        <input type="number" name="price" value="{{ $city->price }}">
                                        <input type="hidden" name="active_tab" value="cities">
                                        <button type="submit" class="btn btn-primary">Обновить</button>
                                    </form>
                                    <form action="{{ route('admin.ad-settings.destroyCity', $city->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Форма для добавления нового города --}}
                <h3>Добавить город</h3>
                <form action="{{ route('admin.ad-settings.storeCity') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название города</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <input type="hidden" name="active_tab" value="cities">
                    <button type="submit" class="btn btn-success">Добавить город</button>
                </form>
            </div>

            {{-- Категории --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'categories' ? 'show active' : '' }}" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                <h2>Категории</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->price }}</td>
                                <td>
                                    <form action="{{ route('admin.ad-settings.updateCategory', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $category->name }}">
                                        <input type="number" name="price" value="{{ $category->price }}">
                                        <input type="hidden" name="active_tab" value="categories">
                                        <button type="submit" class="btn btn-primary">Обновить</button>
                                    </form>
                                    <form action="{{ route('admin.ad-settings.destroyCategory', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Форма для добавления новой категории --}}
                <h3>Добавить категорию</h3>
                <form action="{{ route('admin.ad-settings.storeCategory') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название категории</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <input type="hidden" name="active_tab" value="categories">
                    <button type="submit" class="btn btn-success">Добавить категорию</button>
                </form>
            </div>

            {{-- Пакеты и Социальные сети --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'packages' ? 'show active' : '' }}" id="packages" role="tabpanel" aria-labelledby="packages-tab">
                <h2>Пакеты и Социальные сети</h2>

                <!-- Управление ценами пакетов -->
                <h3>Пакеты</h3>
                <table class="table">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество объявлений</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                        <td>{{ $package->name }}</td>
                            <td>{{ $package->posts_count }}</td>
                            <td>{{ $package->price }}</td>
                            <td>
                                <form action="{{ route('admin.ad-settings.updatePackage', $package->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $package->name }}">
                                    <input type="number" name="posts_count" value="{{ $package->posts_count }}">
                                    <input type="number" name="price" value="{{ $package->price }}">
                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </form>
                                <form action="{{ route('admin.ad-settings.destroyPackage', $package->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

                {{-- Форма для добавления нового пакета --}}
                    <h3>Добавить пакет</h3>
                    <form action="{{ route('admin.ad-settings.storePackage') }}" method="POST">
                        @csrf
                         <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="posts_count">Количество объявлений</label>
                            <input type="number" name="posts_count" id="posts_count" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить пакет</button>
                    </form>

                    {{-- Социальные сети --}}
                    <h3>Социальные сети</h3>
                    <form action="{{ route('admin.ad-settings.updateSocialPrice') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tg_price">Цена для Telegram</label>
                            <input type="number" name="tg_price" id="tg_price" class="form-control" value="{{ $socialPrices->tg_price ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fb_price">Цена для Facebook</label>
                            <input type="number" name="fb_price" id="fb_price" class="form-control" value="{{ $socialPrices->fb_price ?? '' }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить цены</button>
                    </form>
            </div>
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
