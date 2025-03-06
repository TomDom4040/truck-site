<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="container">
        <h1>Пользователи</h1>

        {{-- Форма для поиска по почте --}}
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="form-group">
                <label for="search">Поиск по почте:</label>
                <input type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="Введите email для поиска" class="form-control">
                <button type="submit" class="btn btn-primary">Поиск</button>
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
                                <!-- Галочка для админа -->
                                @if($user->is_admin)
                                    <span class="badge badge-success">Админ</span>
                                @else
                                    <span class="badge badge-secondary">Не админ</span>
                                @endif
                            </td>
                            <td>
                                <!-- Ссылка на редактирование с использованием profile_id -->
                                <a href="{{ route('admin.users.edit', $user->profile_id) }}" class="btn btn-primary">Редактировать</a>
                                <form action="{{ route('admin.users.destroy', $user->profile_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            {{-- Добавим пагинацию --}}
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')
</body>

</html>
