<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    
    @include('header')
    <section class="height_section" id="lk">
        <div class="wrapper">
            <div class="lk">
                <form class="lk_edit" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="avatar_edit">
                        <div class="user_img">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('img/user_avatar.webp') }}" alt="Фото профиля">
                        </div>
                        <input type="file" name="avatar" id="avatar" style="display: none;">
                        <button type="button" class="btn_edit_avatar" onclick="document.getElementById('avatar').click()">установить фото профиля</button>
                    </div>
                    <div class="user_title">
                        <input type="text" name="name" placeholder="Ваше имя" value="{{ $user->name }}">
                        <input type="text" name="about" placeholder="О себе" value="{{ $user->description }}">
                    </div>
                    <div class="user_social_edit">
                
                        
                        <input type="text" name="phone" placeholder="Номер телефона" value="{{ $user->phone }}">
                        <input type="email" name="email" placeholder="Ваш email" value="{{ $user->email }}">
                        @php
                            $socialLinks = json_decode($user->social_links, true) ?? [];
                        @endphp

                        <input type="text" name="telegram" placeholder="Ваш Telegram" value="{{ $socialLinks['telegram'] ?? '' }}">
                        <input type="text" name="instagram" placeholder="Ваш Instagram" value="{{ $socialLinks['instagram'] ?? '' }}">
                        <input type="text" name="facebook" placeholder="Ваш Facebook" value="{{ $socialLinks['facebook'] ?? '' }}">
                        <input type="text" name="tiktok" placeholder="Ваш TikTok" value="{{ $socialLinks['tiktok'] ?? '' }}">
                    </div>
                    <button class="save_btn" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </section>

    @include('footer')
</body>

</html>
