<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Подключение иконок Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="container">
        <h1>Пользователи</h1>

        {{-- Форма для поиска по почте --}}
        <form action="{{ route('admin.users.index') }}" method="GET" class="search-form">
            <div class="form-group">
                <label for="search" class="form-label">Поиск по почте:</label>
                <div class="input-group">
                    <input type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="Введите email для поиска" class="form-control">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Поиск
                    </button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Администратор</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge bg-success">Админ</span>
                                @else
                                    <span class="badge bg-secondary">Не админ</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.users.edit', $user->profile_id) }}" class="btn btn-edit">
                                        <i class="bi bi-pencil"></i> Редактировать
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->profile_id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Удалить
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            {{-- Пагинация --}}
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>