<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Стили остаются прежними */
        .alert {
            margin-top: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .form-control {
            border-radius: 0.375rem;
            padding: 10px;
        }

        .btn {
            border-radius: 0.375rem;
            padding: 10px 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .tab-content {
            margin-top: 30px;
        }

        .tab-pane {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link {
            border-radius: 0.375rem 0.375rem 0 0;
            padding: 10px 20px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .tab-pane table {
            width: 100%;
            border-collapse: collapse;
        }

        .tab-pane table th, .tab-pane table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .tab-pane table th {
            background-color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
        }

        .nav-pills {
            margin-bottom: 20px;
        }

        .nav-pills .nav-link {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

   <div class="container">
    <h1>Управление объявлениями</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Категория</th>
                <th>Город</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>{{ $ad->user->name }}</td>
                <td>{{ $ad->category->name }}</td>
                <td>{{ $ad->city->name ?? 'Не указан' }}</td>
                <td>{{ Str::limit($ad->description, 50) }}</td>
                <td>{{ $ad->status }}</td>
                <td>{{ $ad->price }}</td>
                <td>
                    <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary">Изменить</a>
                    <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    {{-- Подключение футера --}}
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
