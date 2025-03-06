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
        <select name="category_id" id="category" class="ad-form-input" onchange="calculateTotal()">
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
        <select name="city_id" id="city" class="ad-form-input" onchange="calculateTotal()">
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
        <input type="checkbox" name="tg" id="tg" class="ad-form-checkbox" value="{{ $socialPrices->tg_price }}" {{ old('tg') ? 'checked' : '' }} onchange="calculateTotal()">
    </div>
    <div class="ad-form-group">
        <label for="fb" class="ad-form-label">Разместить на Фб</label>
        <input type="checkbox" name="fb" id="fb" class="ad-form-checkbox" value="{{ $socialPrices->fb_price }}" {{ old('fb') ? 'checked' : '' }} onchange="calculateTotal()">
    </div>

    <!-- Пакет -->
    <div class="ad-form-group">
        <label for="package" class="ad-form-label">Выберите пакет</label>
        <select name="package" id="package" class="ad-form-input" onchange="calculateTotal()">
    <option value="" disabled selected>Выберите пакет</option>
    @foreach($packages as $package)
        <option value="{{ $package->id }}" data-price="{{ $package->price }}">
            {{ $package->name }} - ${{ $package->price }}
        </option>
    @endforeach
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
function calculateTotal() {
    let category = document.getElementById("category");
    let city = document.getElementById("city");
    let package = document.getElementById("package");
    let tgCheckbox = document.getElementById("tg");
    let fbCheckbox = document.getElementById("fb");

    let categoryPrice = parseFloat(category.options[category.selectedIndex]?.getAttribute("data-price")) || 0;
    let cityPrice = parseFloat(city.options[city.selectedIndex]?.getAttribute("data-price")) || 0;
    let packagePrice = parseFloat(package.options[package.selectedIndex]?.getAttribute("data-price")) || 0;
    let tgPrice = tgCheckbox.checked ? parseFloat(tgCheckbox.value) || 0 : 0;
let fbPrice = fbCheckbox.checked ? parseFloat(fbCheckbox.value) || 0 : 0;

    let totalPrice = categoryPrice + cityPrice + packagePrice + tgPrice + fbPrice;

    document.getElementById("totalPrice").innerText = totalPrice.toFixed(2);
}

// Слушатели событий для обновления цены
document.getElementById("category").addEventListener("change", calculateTotal);
document.getElementById("city").addEventListener("change", calculateTotal);
document.getElementById("package").addEventListener("change", calculateTotal);
document.getElementById("tg").addEventListener("change", calculateTotal);
document.getElementById("fb").addEventListener("change", calculateTotal);
</script>


    {{-- Подключение футера --}}
    @include('footer')
</body>

</html>
