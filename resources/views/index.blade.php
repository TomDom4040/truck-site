<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')
    @guest
    <div class="swipe_header_main">
            <h3>Доска объявлений в США</h3>
            <a class="link_create" href="{{ url('/register') }}"">Создать аккаунт</a>
            <button class="btn_swipe">Перейти в ленту <img src="img/arrow.svg" alt=""></button>
    </div
    @endguest
    <section id="board">
        <div class="container">
        @foreach($ads as $ad)
    <div class="post">
        <div class="post_header">
            <a href="" class="account_post">
                <div class="avatar">
                    <img src="{{ asset('storage/' . $ad->user->avatar) }}" alt="Avatar">
                </div>
                <div class="account_info_post">
                    <span class="name_post">
                        {{ $ad->user->name }}
                    </span>
                    <span class="time_public">
                        {{ $ad->created_at->format('H:i A') }}
                    </span>
                </div>
            </a>
            <div class="post_location">
                <span class="location">{{ $ad->city->name ?? 'Unknown City' }}</span>
                <div class="filters">
                    <div id="car">🚘</div>
                    <div id="house">🏠</div>
                </div>
            </div>
            <div class="settings_post">
                <button><img src="{{ asset('img/settings.svg') }}" alt="Settings"></button>
            </div>
        </div>

        <div class="post_content">
            

            <!-- Изображения/видео -->
            @if (!empty($ad->media) && $ad->media->count() > 0)
                @foreach($ad->media as $media)
                    @if ($media->type === 'image')
                        <div class="image-placeholder">
                            <img src="{{ asset('storage/' . $media->path) }}" alt="Image" class="post-media">
                        </div>
                    @elseif ($media->type === 'video')
                        <div class="image-placeholder">
                            <video controls class="post-media">
                                <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                @endforeach
            @endif
            <!-- Контент объявления -->
            <div class="content">
                {{ $ad->description }}
            </div>
        </div>

        <div class="actions">
            <span>Like <p style="margin-top: -3px; margin-left: 3px;">👍</p></span>
            <span>Share ↩︎</span>
        </div>
    </div>
@endforeach


            <!-- Format 1: With Video Placeholder -->
            <div class="post">
                <div class="post_header">
                    <a href="" class="account_post">
                        <div class="avatar">
                            <img src="" alt="">
                        </div>
                        <div class="account_info_post">
                            <span class="name_post">
                                Tom Jons
                            </span>
                            <span class="time_public">
                                11:00 AM
                            </span>
                        </div>
                    </a>
                    <div class="post_location">
                        <span class="location">Los Angeles</span>
                        <div class="filters">
                            <div id="car">🚘</div>
                            <!-- <div id="car">🏠</div> -->
                        </div>
                    </div>
                    <div class="settings_post">
                        <button><img src="img/settings.svg" alt=""></button>
                    </div>
                </div>
                <div class="post_content">
                    <div class="video-placeholder"></div>
                    <div class="content">
                        🚗 Мы вас научим эффективно работь с уцуусаусусууссссссс Dооrdash, Grubhub и Ubеr Еаts. 🔥 После обучения ваш ауоти заработок достигнет 25-30$ в час, независимo от времени суток и дня недели.🚗 Мы вас научим эффективно работь с уцуусаусусууссссссс Dооrdash,
                        Grubhub и Ubеr Еаts. 🔥 После обучения ваш ауоти заработок достигнет 25-30$ в час, независимo от времени суток и

                    </div>
                </div>
                <div class="actions">
                    <span>Like <p style="margin-top: -3px; margin-left: 3px;">👍</p></span>
                    <span>Share ↩︎</span>
                </div>
            </div>

            <div class="post">
                <div class="post_header">
                    <a href="" class="account_post">
                        <div class="avatar">
                            <img src="" alt="">
                        </div>
                        <div class="account_info_post">
                            <span class="name_post">
                                Tom Jons
                            </span>
                            <span class="time_public">
                                11:00 AM
                            </span>
                        </div>
                    </a>
                    <div class="post_location">
                        <span class="location">New York</span>
                        <div class="filters">
                            <div id="car">🚘</div>
                            <div id="car">🏠</div>
                        </div>
                    </div>
                    <div class="settings_post">
                        <button><img src="img/settings.svg" alt=""></button>
                    </div>
                </div>
                <div class="post_content">

                    <div class="content">
                        🚗 Мы вас научим эффективно работь с Dооrdash, Grubhub и Ubеr Еаts. 🔥 После обучения ваш заработок достигнет 25-30$ в час, независимo от времени суток и дня недели. 🚗 Мы вас научим эффективно работь с Dооrdash, Grubhub и Ubеr Еаts. 🔥 После обучения
                        ваш заработок достигнет 25-30$ в час, независимo от времени суток и дня недели.
                    </div>
                </div>
                <div class="actions">
                    <span>Like <p style="margin-top: -3px; margin-left: 3px;">👍</p></span>
                    <span>Share ↩︎</span>
                </div>
            </div>

            <div class="post">
                <div class="post_header">
                    <a href="" class="account_post">
                        <div class="avatar">
                            <img src="" alt="">
                        </div>
                        <div class="account_info_post">
                            <span class="name_post">
                                Tom Jons
                            </span>
                            <span class="time_public">
                                11:00 AM
                            </span>
                        </div>
                    </a>
                    <div class="post_location">
                        <span class="location">New York</span>
                        <div class="filters">
                            <div id="car">🚘</div>
                            <div id="car">🏠</div>
                        </div>
                    </div>
                    <div class="settings_post">
                        <button><img src="img/settings.svg" alt=""></button>
                    </div>
                </div>
                <div class="post_content">
                    <div class="image-placeholder"></div>
                    <div class="content">
                        🚗 Мы вас научим ваааааааэффективно работь с fhvbveck Dооrdash, Grubhub и Ubеr Еаts. 🔥 После обучения ваш заработок достигнет 25-30$ в час, независимo от времени суток и дня недели.
                    </div>
                </div>
                <div class="actions">
                    <span>Like <p style="margin-top: -3px; margin-left: 3px;">👍</p></span>
                    <span>Share ↩︎</span>
                </div>
            </div>
            
        </div>
    </section>
   
    {{-- Подключение футера --}}
    @include('footer')

</body>

</html>