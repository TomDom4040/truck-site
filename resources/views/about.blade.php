<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us - Mobile Truck Repair</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20260813l.css">
<style>
  /* Лок для About: убираем любые левые отступы/абзацные отступы */
  .about-page .container *{
    margin-left:0 !important;
    padding-left:0 !important;
    text-indent:0 !important;
  }
  /* Шрифт: родной системный (на маке и айфоне это San Francisco — он мягче
     и ровнее, чем Helvetica, которой страница довольствовалась раньше),
     чуть крупнее, мягкий чёрный вместо чистого, и длина строки ограничена —
     глазу тяжело возвращаться к началу очень длинной строки. */
  .about-page .container article{
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                 "Helvetica Neue", Arial, sans-serif;
    font-size: 17px;
    color: #23282d;
    max-width: 62ch;
    -webkit-font-smoothing: antialiased;
  }
  /* Строки идут плотнее: и сама высота строки, и просветы между абзацами */
  .about-page .container article{ line-height: 1.32 !important; }
  .about-page .container p{ margin: 0 0 8px !important; }
  /* Заголовок вплотную к первой строке текста — и в английском блоке, и в русском */
  .about-page .container h1,
  .about-page .container h2{ margin: 0 !important; line-height: 1.32 !important; }
  /* Список услуг: правило выше сносит отступ у <ul> и маркеры уезжают за край,
     поэтому маркеры уводим внутрь строки. */
  .about-page .services-list{
    list-style: none !important;
    margin: 0 !important;             /* список идёт сразу под своей строкой-вступлением */
  }
  .about-page .container p.lead-in{ margin-bottom: 0 !important; }
  .about-page .services-list li{
    position: relative;
    padding-left: 18px !important;   /* перебиваем общий лок выше */
    margin-bottom: 0 !important;
  }
  .about-page .services-list li::before{
    content: '—';
    position: absolute; left: 0; top: 0;
  }
  /* Русский блок — второй, отделён чертой */
  .about-page .lang-ru{
    margin-top: 22px !important;
    padding-top: 18px !important;
    border-top: 1px solid rgba(0,0,0,.12);
  }
  .about-page .lang-ru h2{ margin-top: 0 !important; }
</style>
</head>
<body class="page-wrap about-page">
  @include('partials.header')

  <main class="page-body">
    <div class="container">
      <article lang="en">
        <h1>About Us</h1>
        <p>We are an experienced truck and trailer repair team in Los Angeles.</p>
        <p class="lead-in">We handle all types of work:</p>
        <ul class="services-list">
          <li>valve repair</li>
          <li>engine repair</li>
          <li>APU diagnostics and repair</li>
          <li>computer diagnostics</li>
          <li>DEF system repair</li>
          <li>cooling system repair</li>
          <li>air conditioning (A/C) repair</li>
          <li>fuel system repair</li>
          <li>clutch replacement</li>
          <li>and more</li>
        </ul>
      </article>

      <article class="lang-ru" lang="ru">
        <h2>О нас</h2>
        <p>Мы опытная команда по ремонту траков и трейлеров в Лос-Анджелесе.</p>
        <p class="lead-in">Мы выполняем все виды работ:</p>
        <ul class="services-list">
          <li>ремонт клапанов</li>
          <li>ремонт двигателя</li>
          <li>диагностика и ремонт APU</li>
          <li>компьютерная диагностика</li>
          <li>ремонт DEF</li>
          <li>ремонт систем охлаждения</li>
          <li>ремонт систем кондиционирования (A/C)</li>
          <li>ремонт топливной системы</li>
          <li>замена сцепления</li>
          <li>другое</li>
        </ul>
      </article>
    </div>
  </main>

  @include('partials.footer')
</body>
</html>