<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('header')
    <section class="height_section" id="lk">
        <div class="wrapper">
            <div class="lk">
                <div class="top_content_lk">
                

                    <div class="user_img">
                        <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('img/user_avatar.webp') }}" alt="Аватар пользователя" class="user-avatar">
                    </div>
                    <div class="user_title">
                        <!-- Имя пользователя -->
                        <h3 class="user_name">{{ $user->name }}</h3>
                        <p class="user_info">{{ $user->description ?? 'Информация о пользователе отсутствует.' }}</p>
                    </div>
                    <div class="user_social">
                        <h4>Контакты и социальные сети:</h4>
                        {{-- Вывод данных профиля --}}
                        <ul>
                            {{-- Телефон --}}
                            @if (!empty($user->phone))
                                <li>
                                    <img src="{{ asset('img/social_icon/tel.svg') }}" alt="">
                                    <a href="tel:+{{ $user->phone }}">{{ $user->phone }}</a>
                                </li>
                            @endif

                            {{-- Email --}}
                            @if (!empty($user->email))
                                <li>
                                    <img src="{{ asset('img/social_icon/email.svg') }}" alt="">
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </li>
                            @endif

                           {{-- Социальные сети --}}
                            @php
                                $socialLinks = json_decode($user->social_links, true) ?? [];
                            @endphp

                            @foreach ($socialLinks as $platform => $link)
                                @if (!empty($link))
                                    <li>
                                       <img src="{{ asset('img/social_icon/' . $platform . '.svg') }}" alt="">
                                        <a href="{{ $link }}" target="_blank">{{ $link }}</a> <!-- Отображаем сам введенный пользователем текст -->
                                    </li>
                                @endif
                            @endforeach
                        </ul>


                    </div>
                </div>
                <div class="bottom_content_lk">
                    <a href="{{ route('profile.edit') }}">Редактировать</a>
                    <a href="{{ route('ads.my') }}">Мои объявления</a>
                </div>
            </div>
        </div>
    </section>

    @include('footer')
</body>

</html>