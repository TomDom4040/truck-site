<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки аккаунта - Elka Club</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-btn {
            background:rgba(36, 200, 250, 0.51);
                height: 40px;
                cursor: pointer;
    border-radius: 20px;
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.05em;
    color: #FFFFFF;
    padding: 0 10px;
    width: 100%;
    max-width: 200px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex
;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    
        }

        .tab-btn.active {
            background: #24C9FA;
            color: white;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .notification.success {
            background-color: #4CAF50;
            color: white;
        }

        .notification.error {
            background-color: #f44336;
            color: white;
        }
        .lk h2{
            font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 20px;
    letter-spacing: 0.05em;
    color: #24C9FA;
    margin: 0 auto;
    margin-bottom: 20px;
    text-align: center;
    width: 100%;
        }
    </style>
</head>

<body>

    @include('header')

    <section class="height_section" id="settings">
    <div class="wrapper">
        <div class="lk">

            <div class="tabs">
                <div class="tab-btn active" data-tab="email-tab">Изменение Email</div>
                <div class="tab-btn" data-tab="password-tab">Изменение пароля</div>
            </div>

            {{-- Форма изменения email --}}
            <div class="tab active" id="email-tab">
                <form class="lk_edit" action="{{ route('settings.sendVerificationCode') }}" method="POST" id="email-form">
                    @csrf
                    <h2>Изменение Email</h2>
                    <div class="user_social_edit" id="email-fields">
                        <input type="email" name="new_email" placeholder="Новый Email" required>
                        <input type="password" name="email_password" placeholder="Текущий пароль" required>
                    </div>
                    <button class="save_btn" type="submit">Получить код</button>
                </form>

                <!-- Поле для кода подтверждения -->
                <div id="verification-form-container" style="display:none;">
                    <form class="lk_edit" action="{{ route('settings.updateEmail') }}" method="POST" id="verification-form">
                        
                        @csrf
                        <h2>Подтверждение</h2>
                        <div class="user_social_edit">
                            <input type="text" name="verification_code" placeholder="Введите код" required>
                        </div>
                        <button class="save_btn" type="submit">Подтвердить Email</button>
                    </form>
                </div>
            </div>


            {{-- Форма изменения пароля --}}
            <div class="tab" id="password-tab">
                <form class="lk_edit" action="{{ route('settings.updatePassword') }}" method="POST">
                    @csrf
                    <h2>Изменение пароля</h2>
                    <div class="user_social_edit">
                        <input type="password" name="current_password" placeholder="Текущий пароль" required>
                        <input type="password" name="new_password" placeholder="Новый пароль" required>
                        <input type="password" name="new_password_confirmation" placeholder="Подтвердите новый пароль" required>
                    </div>
                    <button class="save_btn" type="submit">Сохранить</button>
                </form>
            </div>

        </div>
    </div>
    @if(session('success'))
    <div class="notification success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="notification error">{{ $errors->first() }}</div>
    @endif
</section>

    @include('footer')

</body>

</html>
