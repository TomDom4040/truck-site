<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки объявлений - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="ad-settings-container">
        <h1>Настройки объявлений</h1>

        {{-- Сообщения об успехе --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Вкладки -->
        <ul class="nav nav-pills ad-settings-tabs" id="settingsTabs" role="tablist">
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

        <div class="tab-content ad-settings-tab-content" id="settingsTabsContent">
            {{-- Города --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'cities' ? 'show active' : '' }}" id="cities" role="tabpanel" aria-labelledby="cities-tab">
                <h2>Города</h2>
                <table class="ad-settings-table">
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
                                    <form action="{{ route('admin.ad-settings.updateCity', $city->id) }}" method="POST" class="ad-settings-form-group">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $city->name }}" class="ad-settings-form-control">
                                        <input type="number" name="price" value="{{ $city->price }}" class="ad-settings-form-control">
                                        <input type="hidden" name="active_tab" value="cities">
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-primary">Обновить</button>
                                    </form>
                                    <form action="{{ route('admin.ad-settings.destroyCity', $city->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Форма для добавления нового города --}}
                <h3>Добавить город</h3>
                <form action="{{ route('admin.ad-settings.storeCity') }}" method="POST" class="ad-settings-form-group">
                    @csrf
                    <div class="ad-settings-form-group">
                        <label for="name" class="ad-settings-form-label">Название города</label>
                        <input type="text" name="name" id="name" class="ad-settings-form-control" required>
                    </div>
                    <div class="ad-settings-form-group">
                        <label for="price" class="ad-settings-form-label">Цена</label>
                        <input type="number" name="price" id="price" class="ad-settings-form-control" required>
                    </div>
                    <input type="hidden" name="active_tab" value="cities">
                    <button type="submit" class="ad-settings-btn ad-settings-btn-success">Добавить город</button>
                </form>
            </div>

            {{-- Категории --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'categories' ? 'show active' : '' }}" id="categories" role="tabpanel" aria-labelledby="categories-tab">
                <h2>Категории</h2>
                <table class="ad-settings-table">
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
                                    <form action="{{ route('admin.ad-settings.updateCategory', $category->id) }}" method="POST" class="ad-settings-form-group">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $category->name }}" class="ad-settings-form-control">
                                        <input type="number" name="price" value="{{ $category->price }}" class="ad-settings-form-control">
                                        <input type="hidden" name="active_tab" value="categories">
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-primary">Обновить</button>
                                    </form>
                                    <form action="{{ route('admin.ad-settings.destroyCategory', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Форма для добавления новой категории --}}
                <h3>Добавить категорию</h3>
                <form action="{{ route('admin.ad-settings.storeCategory') }}" method="POST" class="ad-settings-form-group">
                    @csrf
                    <div class="ad-settings-form-group">
                        <label for="name" class="ad-settings-form-label">Название категории</label>
                        <input type="text" name="name" id="name" class="ad-settings-form-control" required>
                    </div>
                    <div class="ad-settings-form-group">
                        <label for="price" class="ad-settings-form-label">Цена</label>
                        <input type="number" name="price" id="price" class="ad-settings-form-control" required>
                    </div>
                    <input type="hidden" name="active_tab" value="categories">
                    <button type="submit" class="ad-settings-btn ad-settings-btn-success">Добавить категорию</button>
                </form>
            </div>

            {{-- Пакеты и Социальные сети --}}
            <div class="tab-pane fade {{ request()->input('active_tab') == 'packages' ? 'show active' : '' }}" id="packages" role="tabpanel" aria-labelledby="packages-tab">
                <h2>Пакеты и Социальные сети</h2>

                <!-- Управление ценами пакетов -->
                <h3>Пакеты</h3>
                <table class="ad-settings-table">
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
                                    <form action="{{ route('admin.ad-settings.updatePackage', $package->id) }}" method="POST" class="ad-settings-form-group">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $package->name }}" class="ad-settings-form-control">
                                        <input type="number" name="posts_count" value="{{ $package->posts_count }}" class="ad-settings-form-control">
                                        <input type="number" name="price" value="{{ $package->price }}" class="ad-settings-form-control">
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-primary">Обновить</button>
                                    </form>
                                    <form action="{{ route('admin.ad-settings.destroyPackage', $package->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ad-settings-btn ad-settings-btn-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Форма для добавления нового пакета --}}
                <h3>Добавить пакет</h3>
                <form action="{{ route('admin.ad-settings.storePackage') }}" method="POST" class="ad-settings-form-group">
                    @csrf
                    <div class="ad-settings-form-group">
                        <label for="name" class="ad-settings-form-label">Название</label>
                        <input type="text" name="name" id="name" class="ad-settings-form-control" required>
                    </div>
                    <div class="ad-settings-form-group">
                        <label for="posts_count" class="ad-settings-form-label">Количество объявлений</label>
                        <input type="number" name="posts_count" id="posts_count" class="ad-settings-form-control" required>
                    </div>
                    <div class="ad-settings-form-group">
                        <label for="price" class="ad-settings-form-label">Цена</label>
                        <input type="number" name="price" id="price" class="ad-settings-form-control" required>
                    </div>
                    <button type="submit" class="ad-settings-btn ad-settings-btn-success">Добавить пакет</button>
                </form>

                {{-- Социальные сети --}}
                <h3>Социальные сети</h3>
                <form action="{{ route('admin.ad-settings.updateSocialPrice') }}" method="POST" class="ad-settings-form-group">
                    @csrf
                    <div class="ad-settings-form-group">
                        <label for="tg_price" class="ad-settings-form-label">Цена для Telegram</label>
                        <input type="number" name="tg_price" id="tg_price" class="ad-settings-form-control" value="{{ $socialPrices->tg_price ?? '' }}" required>
                    </div>
                    <div class="ad-settings-form-group">
                        <label for="fb_price" class="ad-settings-form-label">Цена для Facebook</label>
                        <input type="number" name="fb_price" id="fb_price" class="ad-settings-form-control" value="{{ $socialPrices->fb_price ?? '' }}" required>
                    </div>
                    <button type="submit" class="ad-settings-btn ad-settings-btn-primary">Обновить цены</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>