<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать объявление - Elka Club</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    {{-- Подключение шапки --}}
    @include('header')

    <div class="ad-form-container wrapper">
        <h2 class="ad-form-title">Создать объявление</h2>

        <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Категория -->
            <div class="ad-form-group">
                <label for="category" class="ad-form-label">Категория</label>
                <select name="category_id" id="category" class="ad-form-input" onchange="updatePrices()">
                    <option value="" disabled selected>Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                data-price-photo="{{ $category->price_photo }}"
                                data-price-video="{{ $category->price_video }}"
                                data-price="{{ $category->price }}">
                            {{ $category->name }} (Фото: ${{ $category->price_photo }}, Видео: ${{ $category->price_video }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Город -->
            <div class="ad-form-group">
                <label for="city" class="ad-form-label">Город</label>
                <select name="city" id="city" class="ad-form-input" onchange="updatePrices()">
                    <option value="" disabled selected>Выберите город</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" data-price="{{ $city->price }}">
                            {{ $city->name }} (Цена: ${{ $city->price }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Тема объявления -->
            <div class="ad-form-group">
                <label for="theme" class="ad-form-label">Тема объявления</label>
                <select name="theme" id="theme" class="ad-form-input" onchange="updatePrices()">
                    <option value="" disabled selected>Выберите тему</option>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" data-price="{{ $theme->price }}">
                            {{ $theme->name }} (Цена: ${{ $theme->price }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Медиа -->
            <div class="ad-form-group">
                <label class="ad-form-label">Прикрепить фото/видео</label>
                <input type="file" name="media[]" id="media" class="ad-form-input" multiple accept="image/*,video/*" onchange="calculateTotal()">
            </div>

            <!-- Размещение на Тг и Фб -->
            <div class="ad-form-group">
                <label for="tg" class="ad-form-label">Разместить на Тг</label>
                <input type="checkbox" name="tg" id="tg" class="ad-form-checkbox" onchange="calculateTotal()">
            </div>
            <div class="ad-form-group">
                <label for="fb" class="ad-form-label">Разместить на Фб</label>
                <input type="checkbox" name="fb" id="fb" class="ad-form-checkbox" onchange="calculateTotal()">
            </div>

            <!-- Пакет -->
            <div class="ad-form-group">
                <label for="package" class="ad-form-label">Выберите пакет</label>
                <select name="package" id="package" class="ad-form-input" onchange="updatePrices()">
                    <option value="" disabled selected>Выберите пакет</option>
                    <option value="1" data-price="1">1 объявление</option>
                    <option value="5" data-price="4">5 объявлений</option>
                    <option value="10" data-price="7">10 объявлений</option>
                    <option value="30" data-price="15">30 объявлений</option>
                </select>
            </div>

            <!-- Итоговая стоимость -->
            <p class="ad-total-price">Итоговая стоимость: $<span id="totalPrice">0</span></p>

            <button type="submit" class="ad-form-button">Перейти к оплате</button>
        </form>
    </div>

    <script>
        function updatePrices() {
            let category = document.getElementById("category");
            let city = document.getElementById("city");
            let theme = document.getElementById("theme");
            let package = document.getElementById("package");
            let tg = document.getElementById("tg");
            let fb = document.getElementById("fb");

            let categoryPrice = parseFloat(category.options[category.selectedIndex].getAttribute("data-price")) || 0;
            let cityPrice = parseFloat(city.options[city.selectedIndex].getAttribute("data-price")) || 0;
            let themePrice = parseFloat(theme.options[theme.selectedIndex].getAttribute("data-price")) || 0;
            let packagePrice = parseFloat(package.options[package.selectedIndex].getAttribute("data-price")) || 0;

            let totalPrice = categoryPrice + cityPrice + themePrice + packagePrice;

            if (tg.checked) totalPrice += 1;  // Цена за Тг
            if (fb.checked) totalPrice += 1.5;  // Цена за Фб

            document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
        }

        function calculateTotal() {
            let media = document.getElementById("media").files;
            let pricePhoto = parseFloat(document.getElementById("media").getAttribute("data-price-photo")) || 0;
            let priceVideo = parseFloat(document.getElementById("media").getAttribute("data-price-video")) || 0;

            // Цена города
            let citySelect = document.getElementById("city");
            let cityPrice = parseFloat(citySelect.options[citySelect.selectedIndex]?.getAttribute("data-price")) || 0;

            let totalPrice = cityPrice; // Начинаем с цены города

            for (let i = 0; i < media.length; i++) {
                if (media[i].type.startsWith("image")) {
                    totalPrice += pricePhoto;
                } else if (media[i].type.startsWith("video")) {
                    totalPrice += priceVideo;
                }
            }

            document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
        }
    </script>

    {{-- Подключение футера --}}
    @include('footer')
</body>

</html>
