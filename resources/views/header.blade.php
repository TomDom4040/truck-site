<header class="header_main">
    <div class="wrapper">
        <div class="header">
            <a href="{{ url('/') }}"><img src="{{ asset('img/logo.svg') }}" alt=""></a>
           <div class="right_menu">
            @auth
                    <a href="{{ route('ads.create') }}" class="create_btn">Разместить пост</a>
                @endauth
            <button class="burger_menu">
                <img src="{{ asset('img/burger.svg') }}" alt="">
            </button>
            </div>
        </div>
        
    </div>
    <div class="burger_menu_content">
        
        <ul>
            {{-- Для авторизованного пользователя --}}
            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.index') }}">Админ-панель</a></li>
                @endif
                <li><a href="{{ url('profile/' . auth()->user()->profile_id) }}">Аккаунт</a></li>
                 
                
                <li><a href="{{ route('ads.my') }}">Мои объявления</a></li>
                <li><a href="{{ route('profile-settings') }}">Настройки</a></li>

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
