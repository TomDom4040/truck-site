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
                <option value="{{ $category->id }}" data-price="{{ $category->price }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Город -->
    <div class="ad-form-group">
        <label for="city" class="ad-form-label">Город</label>
        <select name="city_id" id="city" class="ad-form-input" onchange="updatePrices()">
            <option value="" disabled selected>Выберите город</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" data-price="{{ $city->price }}">
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Описание объявления -->
    <div class="ad-form-group">
        <label for="description" class="ad-form-label">Описание объявления</label>
        <textarea name="description" id="description" class="ad-form-input" rows="4" maxlength="500" oninput="updateCharCount()"></textarea>
        <small id="charCount">0/500</small>
    </div>

    <!-- Медиа -->
    <div class="ad-form-group">
        <label class="ad-form-label">Прикрепить фото/видео</label>
        <input type="file" name="media[]" id="media" class="ad-form-input" multiple accept="image/*,video/*" onchange="calculateTotal()">
    </div>

    <!-- Размещение на Тг и Фб -->
    <div class="ad-form-group">
        <label for="tg" class="ad-form-label">Разместить на Тг</label>
        <input type="checkbox" name="tg" id="tg" class="ad-form-checkbox" value="1" {{ old('tg') ? 'checked' : '' }} onchange="calculateTotal()">
    </div>
    <div class="ad-form-group">
        <label for="fb" class="ad-form-label">Разместить на Фб</label>
        <input type="checkbox" name="fb" id="fb" class="ad-form-checkbox" value="1" {{ old('fb') ? 'checked' : '' }} onchange="calculateTotal()">
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

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>

</div>

<script>
function updateCharCount() {
    var textarea = document.getElementById("description");
    var charCount = document.getElementById("charCount");
    var currentLength = textarea.value.length;
    charCount.textContent = currentLength + "/500";
    // Блокировка ввода лишних символов (хотя атрибут maxlength уже ограничивает ввод)
    if (currentLength > 500) {
        textarea.value = textarea.value.substring(0, 500);
        charCount.textContent = "500/500";
    }
}
function updatePrices() {
    let category = document.getElementById("category");
    let city = document.getElementById("city");
    let package = document.getElementById("package");
    let tg = document.getElementById("tg");
    let fb = document.getElementById("fb");

    // Извлекаем данные о стоимости из атрибутов
    let categoryPrice = parseFloat(category.options[category.selectedIndex]?.getAttribute("data-price")) || 0;
    let cityPrice = parseFloat(city.options[city.selectedIndex]?.getAttribute("data-price")) || 0;
    let packagePrice = parseFloat(package?.options[package.selectedIndex]?.getAttribute("data-price")) || 0;

    // Инициализируем итоговую стоимость
    let totalPrice = categoryPrice + cityPrice + packagePrice;

    // Добавляем стоимость за Тг и Фб
    if (tg.checked) totalPrice += 1;  // Цена за Тг
    if (fb.checked) totalPrice += 1.5;  // Цена за Фб

    // Обновляем итоговую стоимость
    document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
}

function calculateTotal() {
    let media = document.getElementById("media").files;

    // Цена города
    let citySelect = document.getElementById("city");
    let cityPrice = parseFloat(citySelect.options[citySelect.selectedIndex]?.getAttribute("data-price")) || 0;

    let totalPrice = cityPrice; // Начинаем с цены города

    // Обновляем итоговую стоимость
    document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
}

// Добавляем слушатели событий для всех полей
document.getElementById("category").addEventListener("change", updatePrices);
document.getElementById("city").addEventListener("change", updatePrices);
document.getElementById("package").addEventListener("change", updatePrices);
document.getElementById("tg").addEventListener("change", updatePrices);
document.getElementById("fb").addEventListener("change", updatePrices);
document.getElementById("media").addEventListener("change", calculateTotal);
</script>


    {{-- Подключение футера --}}
    @include('footer')
</body>

</html>
