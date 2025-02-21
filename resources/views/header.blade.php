<header class="header_main">
    <div class="wrapper">
        <div class="header">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.svg') }}" alt=""></a>
            <button class="burger_menu">
                <img src="{{ asset('img/burger.svg') }}" alt="">
            </button>
        </div>
    </div>

    <div class="burger_menu_content">
        <div class="burger_header">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo_circle.svg') }}" alt=""></a>
            <div class="button_burger">
                <button class="filter">
                    <img src="{{ asset('img/search.svg') }}" alt="">
                </button>
                <button class="close_burger">
                    <img src="{{ asset('img/close_burger.svg') }}" alt="">
                </button>
            </div>
        </div>
        <ul>
            {{-- Для авторизованного пользователя --}}
            @auth
                  <li><a class="add_link" href="{{ route('ads.create') }}">Подать объявление</a></li>
                <li><a href="{{ url('profile/' . auth()->user()->profile_id) }}">Аккаунт</a></li>
                <li><a href="{{ route('ads.my') }}">Мои объявления</a></li>
                <li><a href="{{ url('/profile_edit') }}"">Настройки</a></li>
                <li><a href="#">Тех.поддержка</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            Выход
                        </button>
                    </form>
                </li>
            @endauth

            {{-- Для гостя (неавторизованного пользователя) --}}
            @guest
                <li><a href="{{ url('/login') }}">Вход</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
            @endguest
        </ul>
    </div>
</header>
 <div id="copy-message" class="copy-message" style="display:none;">
    Ссылка скопирована!
</div>
