<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <!-- Страница не масштабируется: двойной тап больше не увеличивает.
       touch-action:manipulation — это как раз то, что понимает Safari на айфоне
       (сам по себе user-scalable=no он игнорирует). -->
  <style>
    /* touch-action НЕ наследуется: правило на html гасило двойной тап только
       на самом html, а внутри подвала и других блоков он снова работал.
       Поэтому вешаем на все элементы. */
    *{ touch-action: manipulation; }
    html{ -webkit-text-size-adjust: 100%; }
  </style>
  <title>Mobile Truck Repair in Los Angeles Area</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20260813l.css">
<style>
  /* Мигающая стрелка на карте: указывает точно в нижнее остриё метки.
     Координаты — в единицах самой картинки (1418×1149), поэтому стрелка
     остаётся на месте при любом размере экрана. */
  .map .route-link{ position: relative; display: block; }
  .map-arrow{
    position: absolute; inset: 0; width: 100%; height: 100%;
    pointer-events: none;              /* тап по карте по-прежнему открывает маршрут */
    animation: map-arrow-blink .8s steps(1, end) infinite;
  }
  /* Мигание резкое, без плавного затухания: значение держится половину цикла
     и переключается скачком (steps + постоянные значения в кадрах). */
  /* Баннер услуг — список без родных маркеров, точки рисуем сами */
  .services-block .services-head{ font-weight: 700; margin-bottom: 6px; }
  .services-block .services-list{ list-style: none; margin: 0; padding: 0; }
  /* Длинный селектор нарочно: в общем CSS есть правило, обнуляющее padding-left
     у всего внутри .container — обычный отступ оно съедает вместе с маркером. */
  .page-body .container .services-block .services-list li{
    position: relative; padding-left: 16px !important; margin-bottom: 2px;
  }
  .services-block .services-list li::before{ content: '•'; position: absolute; left: 2px; }
  @keyframes map-arrow-blink{ 0%, 49.9%{ opacity: 1 } 50%, 100%{ opacity: 0 } }
</style>
</head>
<body class="page-wrap">
  @include('partials.header')

  <main class="page-body">
    <div class="container">

      <!-- Hero -->
      <div class="top-image">
        <img src="/images/image1.jpg?v=3" alt="Mobile Truck Repair in Los Angeles" />
      </div>

      <!-- Map + text -->
      {{-- Тап по карте или по строке с адресом открывает навигатор с маршрутом.
           Ссылка универсальная: на телефоне её подхватывает приложение карт, на компьютере — сайт. --}}
      @php $routeUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode('5800 Sheila St, Commerce, CA 90040'); @endphp
      <div class="map-and-text">
        <div class="map">
          <a class="route-link" href="{{ $routeUrl }}" target="_blank" rel="noopener" aria-label="Build a route to 5800 Sheila St, Commerce, CA">
            <img src="/images/image.map.png?v=4" alt="Service area map" />
            <svg class="map-arrow" viewBox="0 0 1418 1149" aria-hidden="true">
              <!-- translate — сдвиг всей стрелки; координаты внутри считались от острия метки -->
              <g transform="translate(-22 0)">
                <path d="M445.5 542 Q553 518 601.5 521.6" fill="none" stroke="#ef3b2a"
                      stroke-width="16" stroke-linecap="round"/>
                <path d="M590.6 501.6 L660.5 526 L587.8 539.8 Z" fill="#ef3b2a"/>
              </g>
            </svg>
          </a>
        </div>
        <div class="text-blocks">
          <a class="text-block route-link" href="{{ $routeUrl }}" target="_blank" rel="noopener"><span data-i18n="home.location">Location:</span> 📍 5800 Sheila St, Commerce, CA</a>
          <div class="text-block">☎️ (747) 329-9691</div>
          {{-- Список услуг переехал сюда из подвала: тот же серый баннер,
               что у адреса и телефона. Якорь #services ведёт именно сюда. --}}
          <div class="text-block services-block" id="services">
            <div class="services-head" data-i18n="footer.services">Services:</div>
            <ul class="services-list">
              <li data-i18n="footer.diag">Diagnostics</li>
              <li data-i18n="footer.dpf">DPF Service</li>
              <li data-i18n="footer.electrical">Electrical Repair</li>
              <li data-i18n="footer.oil">Oil Change</li>
              <li data-i18n="footer.brakes">Brake Jobs</li>
              <li data-i18n="footer.air">Air System Repair</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </main>

  @include('partials.footer')
<script>
// На iPhone/iPad ссылку Google Maps браузер открывает в вебе, если приложения нет.
// Родные «Карты» есть всегда — поэтому там подменяем адрес ссылки на них.
(function () {
  if (!/iPhone|iPad|iPod/.test(navigator.userAgent)) return;
  var dest = encodeURIComponent('5800 Sheila St, Commerce, CA 90040');
  document.querySelectorAll('.route-link').forEach(function (a) {
    a.href = 'https://maps.apple.com/?daddr=' + dest + '&dirflg=d';
  });
})();
</script>
</body>
</html>