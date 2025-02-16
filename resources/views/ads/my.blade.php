<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Elka Club</title>

  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')
<section id="board">
        <div class="container">
        <h1>Мои объявления</h1>
        @if($ads->isEmpty())
            <p>У вас еще нет объявлений.</p>
        @else
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
                        <div class="content">
                            {{ $ad->description }}
                        </div>

                        @if(!empty($ad->media) && $ad->media->count() > 0)
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
                    </div>

                    <div class="actions">
                        <span>Like <p style="margin-top: -3px; margin-left: 3px;">👍</p></span>
                        <span>Share ↩︎</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
     </section>
   
    {{-- Подключение футера --}}
    @include('footer')

</body>

</html>