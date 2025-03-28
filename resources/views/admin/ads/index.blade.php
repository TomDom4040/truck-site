<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Объявления - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Современные стили */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 20px;
        }

        .nav-tabs {
            margin-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 0;
        }

        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            background-color: transparent;
        }

        .nav-tabs .nav-link:hover {
            color: #007bff;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 12px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn {
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        .alert {
            margin-top: 20px;
            border-radius: 6px;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .tab-content {
            margin-top: 20px;
        }

        .tab-pane {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-pills .nav-link {
            border-radius: 6px;
            margin-right: 10px;
            padding: 10px 20px;
            background-color: #f8f9fa;
            color: #6c757d;
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

        <!-- Табы для фильтрации -->
        <ul class="nav nav-tabs" id="adsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">Все</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Ожидают рассмотрения</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">Одобренные</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">Отклоненные</button>
            </li>
        </ul>

        <!-- Контент табов -->
        <div class="tab-content" id="adsTabsContent">
            <!-- Все объявления -->
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Категория</th>
                            <th>Город</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
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
                            <td>{{ $ad->price }}</td>
                            <td>
                                <span class="badge bg-{{ $ad->status === 'approved' ? 'success' : ($ad->status === 'rejected' ? 'danger' : 'warning') }}">
                                    {{ $ad->status }}
                                </span>
                            </td>
                            <td>{{ $ad->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ожидают рассмотрения -->
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Категория</th>
                            <th>Город</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads->where('status', 'pending') as $ad)
                        <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->user->name }}</td>
                            <td>{{ $ad->category->name }}</td>
                            <td>{{ $ad->city->name ?? 'Не указан' }}</td>
                            <td>{{ Str::limit($ad->description, 50) }}</td>
                            <td>{{ $ad->price }}</td>
                            <td>{{ $ad->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Одобренные -->
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Категория</th>
                            <th>Город</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads->where('status', 'approved') as $ad)
                        <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->user->name }}</td>
                            <td>{{ $ad->category->name }}</td>
                            <td>{{ $ad->city->name ?? 'Не указан' }}</td>
                            <td>{{ Str::limit($ad->description, 50) }}</td>
                            <td>{{ $ad->price }}</td>
                            <td>{{ $ad->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Отклоненные -->
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Пользователь</th>
                            <th>Категория</th>
                            <th>Город</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads->where('status', 'rejected') as $ad)
                        <tr>
                            <td>{{ $ad->id }}</td>
                            <td>{{ $ad->user->name }}</td>
                            <td>{{ $ad->category->name }}</td>
                            <td>{{ $ad->city->name ?? 'Не указан' }}</td>
                            <td>{{ Str::limit($ad->description, 50) }}</td>
                            <td>{{ $ad->price }}</td>
                            <td>{{ $ad->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">Просмотреть</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>