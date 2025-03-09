<header class="admin-header">
    <div class="container">
        <div class="logo">
            <a href="{{ route('admin.index') }}">Админ-панель</a>
        </div>
        <nav class="admin-nav">
            <ul>
                <li><a href="{{ url('/') }}">Сайт</a></li>
                <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
                <li><a href="{{ route('admin.ad-settings.index') }}">Настройки объявлений</a></li> 
                <li><a href="{{ route('admin.ads.index') }}">Объявления</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">Выйти</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>