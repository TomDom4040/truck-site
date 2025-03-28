<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Редактирование объявления - Админ-панель</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Иконки Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Дополнительные стили */
        .media-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .media-item img,
        .media-item video {
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        .media-item img:hover,
        .media-item video:hover {
            transform: scale(1.05);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .card-body {
            padding: 2rem;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        p {
            margin-bottom: 0.75rem;
            font-size: 1rem;
            color: #333;
        }

        .info-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-section h5 {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1rem;
            color: #0d6efd;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .info-item i {
            margin-right: 0.75rem;
            color: #6c757d;
        }

        .img-thumbnail {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    {{-- Подключение шапки --}}
    @include('admin.header')

    <div class="container my-5">
        <h1>Редактирование объявления</h1>

        <!-- Отображение объявления -->
        <div class="card mb-4">
            <div class="card-body">
                <h2>Объявление #{{ $ad->id }}</h2>

                <!-- Секция с основной информацией -->
                <div class="info-section">
                    <h5><i class="bi bi-info-circle"></i> Основная информация</h5>
                    <div class="info-item">
                        <i class="bi bi-person"></i>
                        <span><strong>Пользователь:</strong> {{ $ad->user->name }} ({{ $ad->user->email }})</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-calendar"></i>
                        <span><strong>Дата создания:</strong> {{ $ad->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-cash-coin"></i>
                        <span><strong>Цена:</strong> {{ $ad->price }}</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-box"></i>
                        <span><strong>Пакет:</strong> {{ $packageName }}</span>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-share"></i>
                        <span><strong>Социальные сети:</strong>
                            @if ($ad->tg) Telegram @endif
                            @if ($ad->fb) Facebook @endif
                        </span>
                    </div>
                </div>

                <!-- Секция с описанием -->
                <div class="info-section">
                    <h5><i class="bi bi-card-text"></i> Описание</h5>
                    <p>{{ $ad->description }}</p>
                </div>

                <!-- Секция с медиа -->
                <div class="info-section">
                    <h5><i class="bi bi-images"></i> Медиа</h5>
                    <div class="media-gallery">
                        @foreach($ad->media as $media)
                            <div class="media-item">
                                @if ($media->type === 'image')
                                    <a href="{{ asset('storage/' . $media->path) }}" data-lightbox="media-gallery" data-title="Изображение">
                                        <img src="{{ asset('storage/' . $media->path) }}" alt="Image" class="img-thumbnail">
                                    </a>
                                @elseif ($media->type === 'video')
                                    <video controls class="img-thumbnail">
                                        <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Секция с статусом -->
                <div class="info-section">
                    <h5><i class="bi bi-check-circle"></i> Статус</h5>
                    <p>
                        Текущий статус: 
                        <span class="badge bg-{{ $ad->status === 'approved' ? 'success' : ($ad->status === 'rejected' ? 'danger' : 'warning') }}">
                            {{ $ad->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Форма редактирования -->
        <form action="{{ route('admin.ads.update', $ad->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" class="form-control" rows="5" maxlength="500" oninput="updateCharCount(this)">{{ $ad->description }}</textarea>
                <small class="text-muted">
                    <span id="charCount">{{ strlen($ad->description) }}</span>/500 символов
                </small>
            </div>
            <div class="form-group">
                <label for="status" class="form-label">Статус</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $ad->status == 'pending' ? 'selected' : '' }}>На рассмотрении</option>
                    <option value="approved" {{ $ad->status == 'approved' ? 'selected' : '' }}>Одобрено</option>
                    <option value="rejected" {{ $ad->status == 'rejected' ? 'selected' : '' }}>Отклонено</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    {{-- Подключение футера --}}
    @include('admin.footer')

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
    function updateCharCount(textarea) {
        const charCount = document.getElementById('charCount');
        charCount.textContent = textarea.value.length;
    }

    // Инициализация при загрузке страницы
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');
        updateCharCount(textarea);
    });
</script>
</body>

</html>