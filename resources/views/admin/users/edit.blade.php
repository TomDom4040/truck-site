<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Подключение иконок Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="edit-user-container">
        <h1>Редактировать пользователя</h1>
        
        {{-- Выводим ошибки валидации, если они есть --}}
        @if ($errors->any())
            <div class="edit-user-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Форма редактирования пользователя --}}
        <form action="{{ route('admin.users.update', $user->profile_id) }}" method="POST" enctype="multipart/form-data" class="edit-user-form">
            @csrf
            @method('PUT')
            
            {{-- Поле для имени --}}
            <div class="edit-user-form-group">
                <label for="name" class="edit-user-form-label">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="edit-user-form-control" required>
            </div>
            
            {{-- Поле для email --}}
            <div class="edit-user-form-group">
                <label for="email" class="edit-user-form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="edit-user-form-control" required>
            </div>
            
            {{-- Поле для телефона --}}
            <div class="edit-user-form-group">
                <label for="phone" class="edit-user-form-label">Телефон</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="edit-user-form-control">
            </div>
            
            {{-- Поле для описания --}}
            <div class="edit-user-form-group">
                <label for="description" class="edit-user-form-label">Описание</label>
                <textarea name="description" id="description" class="edit-user-form-control" rows="4">{{ old('description', $user->description) }}</textarea>
            </div>
            
            {{-- Поле для аватара --}}
            <div class="edit-user-form-group">
                <label for="avatar" class="edit-user-form-label">Аватар</label>
                <input type="file" name="avatar" id="avatar" class="edit-user-form-control">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="edit-user-avatar" width="100">
                @endif
            </div>

            {{-- Поле для социальных ссылок --}}
            <div class="edit-user-form-group">
                <label for="social_links" class="edit-user-form-label">Социальные ссылки</label>
                <input type="text" name="social_links" id="social_links" value="{{ old('social_links', $user->social_links) }}" class="edit-user-form-control">
            </div>

            {{-- Поле для изменения роли админа --}}
            <div class="edit-user-form-group">
                <label for="is_admin" class="edit-user-form-label">Роль администратора</label>
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                <span>{{ $user->is_admin ? 'Админ' : 'Не админ' }}</span>
            </div>

            {{-- Кнопка отправки формы --}}
            <button type="submit" class="edit-user-btn-primary">Сохранить изменения</button>
        </form>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>