<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>

.containers {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Заголовки */
h1 {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 20px;
    color: #333;
}

/* Формы и поля */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 1rem;
    color: #555;
}

input[type="text"],
input[type="email"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    background-color: #f9f9f9;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus,
input[type="file"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
}

textarea {
    resize: vertical;
}

/* Картинка аватара */
img {
    margin-top: 10px;
    border-radius: 5px;
}

/* Кнопка отправки */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    font-size: 1.1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.alert {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.alert ul {
    list-style-type: none;
}

.alert ul li {
    margin-bottom: 5px;
}

/* Адаптивные стили для мобильных устройств */
@media (max-width: 768px) {
    .containers {
        padding: 10px;
        margin: 10px;
    }

    h1 {
        font-size: 1.5rem;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    input[type="file"],
    button[type="submit"] {
        font-size: 1rem;
    }

    button[type="submit"] {
        padding: 10px;
    }

    img {
        max-width: 100%;
        height: auto;
    }
}

@media (max-width: 576px) {
    .form-group {
        margin-bottom: 15px;
    }

    input[type="text"],
    input[type="email"],
    textarea,
    input[type="file"] {
        font-size: 0.9rem;
    }

    button[type="submit"] {
        font-size: 1rem;
    }
}
    </style>
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="containers">
        <h1>Редактировать пользователя</h1>
        
        {{-- Выводим ошибки валидации, если они есть --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Форма редактирования пользователя --}}
        <form action="{{ route('admin.users.update', $user->profile_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- Поле для имени --}}
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>
            
            {{-- Поле для email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>
            
            {{-- Поле для телефона --}}
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            </div>
            
            {{-- Поле для описания --}}
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $user->description) }}</textarea>
            </div>
            
            {{-- Поле для аватара --}}
            <div class="form-group">
                <label for="avatar">Аватар</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100">
                @endif
            </div>

            {{-- Поле для социальных ссылок --}}
            <div class="form-group">
                <label for="social_links">Социальные ссылки</label>
                <input type="text" name="social_links" id="social_links" value="{{ old('social_links', $user->social_links) }}" class="form-control">
            </div>

            {{-- Поле для изменения роли админа --}}
            <div class="form-group">
                <label for="is_admin">Роль администратора</label>
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                <span>{{ $user->is_admin ? 'Админ' : 'Не админ' }}</span>
            </div>

            {{-- Кнопка отправки формы --}}
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>
