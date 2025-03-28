<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Редактирование профиля - Elka Club</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
</head>

<body>
    
    @include('header')
    <section class="height_section" id="lk">
        <div class="wrapper">
            <div class="lk">
                <form class="lk_edit" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- preview -->
                    <div class="avatar_edit">
                        <div class="user_img">
                            <img id="avatarPreview" src="{{ $user->avatar ? Storage::url($user->avatar) : asset('img/user_avatar.webp') }}" alt="Фото профиля">
                        </div>
                        <input type="file" name="avatar" id="avatar" accept="image/*" style="display: none;">
                        <button type="button" class="btn_edit_avatar" onclick="document.getElementById('avatar').click()">Изменить фото</button>
                    </div>

                    <!-- Модалка -->
                    <div id="cropModal" class="ios-modal" style="display:none;">
                        <div class="ios-modal-content">
                            <div class="cropper-container">
                                <img id="cropImage" src="" style="max-width:100%;">
                            </div>
                            <div class="ios-actions">
                                <button type="button" id="cropCancel" class="ios-btn cancel">Отмена</button>
                                <button type="button" id="cropSave" class="ios-btn confirm">Выбрать</button>
                            </div>
                        </div>
                    </div>
                    <div class="user_title">
                        <input type="text" name="name" placeholder="Ваше имя *" value="{{ $user->name }}">
                        <input type="text" name="about" placeholder="О себе" value="{{ $user->description }}">
                    </div>
                    <div class="user_social_edit">
                
                        
                        <input type="text" name="phone" placeholder="Номер телефона" value="{{ $user->phone }}">
                        <input type="email" name="email" placeholder="Ваш email *" value="{{ $user->email }}">
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
<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper;

document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('cropImage').src = event.target.result;
            document.getElementById('cropModal').style.display = 'flex';

            cropper = new Cropper(document.getElementById('cropImage'), {
                aspectRatio: 1,
                viewMode: 1,
                background: false,
                guides: false,
                highlight: false,
                dragMode: 'move',
                cropBoxMovable: false,
                cropBoxResizable: false,
                ready() {
                    // делаем круг
                    const cropBox = document.querySelector('.cropper-crop-box');
                    const face = document.querySelector('.cropper-face');
                    cropBox.style.borderRadius = '50%';
                    face.style.borderRadius = '50%';
                }
            });
        }
        reader.readAsDataURL(file);
    }
});

// Отмена
document.getElementById('cropCancel').addEventListener('click', function() {
    cropper.destroy();
    document.getElementById('cropModal').style.display = 'none';
    document.getElementById('avatar').value = '';
});

// Выбрать (без перезагрузки, только подмена)
document.getElementById('cropSave').addEventListener('click', function() {
    const canvas = cropper.getCroppedCanvas({ width: 500, height: 500 });
    document.getElementById('avatarPreview').src = canvas.toDataURL(); // Показать превью

    // подменяем input
    canvas.toBlob(function(blob) {
        const file = new File([blob], "avatar.png", { type: "image/png" });
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('avatar').files = dt.files;
    });

    cropper.destroy();
    document.getElementById('cropModal').style.display = 'none';
});
</script>


    @include('footer')
</body>

</html>
