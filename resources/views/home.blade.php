<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <!-- Страница не масштабируется: двойной тап больше не увеличивает.
       touch-action:manipulation — это как раз то, что понимает Safari на айфоне
       (сам по себе user-scalable=no он игнорирует). -->
  <style>html{ touch-action: manipulation; -webkit-text-size-adjust: 100%; }</style>
  <title>Mobile Truck Repair in Los Angeles Area</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20260813l.css">
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
          </a>
        </div>
        <div class="text-blocks">
          <a class="text-block route-link" href="{{ $routeUrl }}" target="_blank" rel="noopener"><span data-i18n="home.location">Location:</span> 📍 5800 Sheila St, Commerce, CA</a>
          <div class="text-block">☎️ (747) 329-9691</div>
          <div class="cta-wrap">
            <a href="/form" class="button" data-i18n="home.calc">CALCULATE THE REPAIR COST 💰</a>
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