<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <!-- Страница не масштабируется: двойной тап больше не увеличивает.
       touch-action:manipulation — это как раз то, что понимает Safari на айфоне
       (сам по себе user-scalable=no он игнорирует). -->
  <style>html{ touch-action: manipulation; -webkit-text-size-adjust: 100%; }</style>
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
    content: '•';
    position: absolute; left: 2px; top: 0;
  }
  /* Русский блок — второй, отделён чертой */
  /* Блоки показываются по одному (переключатель языка), поэтому черта
     сверху и отступ русскому блоку больше не нужны. */
  .about-page .lang-ru{ margin-top: 0 !important; padding-top: 0 !important; }
  .about-page .lang-ru h2{ margin-top: 0 !important; }
  /* На телефоне текст чуть мельче — 16px вместо 17px.
     Порог 639px тот же, что у мобильной вёрстки всего сайта. */
  @media (max-width: 639px){
    .about-page .container article{ font-size: 16px; }
    /* Отступ от левого края экрана. Селектор длинный нарочно: и лок выше,
       и правило в общем CSS сайта сносят padding-left у всего внутри
       .container — перебиваем их более точным селектором. */
    .about-page .page-body .container article{ padding-left: 14px !important; }
  }
  /* Флажки рисуем сами: эмодзи-флаги на Windows показываются буквами «US»/«RU» */
  .about-page .flag{
    /* в CSS сайта у всех svg стоит display:block — без этой строки
       флажок уезжает на строку выше заголовка */
    display: inline-block !important;
    vertical-align: -1px;
    margin-left: 8px !important;   /* флажок стоит справа от заголовка */
    border-radius: 2px;
  }
</style>
</head>
<body class="page-wrap about-page">
  @include('partials.header')

  <main class="page-body">
    <div class="container">
      <article lang="en" data-lang-block="en">
        <h1>About Us<svg class="flag" viewBox="0 0 38 20" width="25" height="13" aria-hidden="true"><rect x="0" y="0.000" width="38" height="1.538" fill="#b22234"/><rect x="0" y="1.538" width="38" height="1.538" fill="#fff"/><rect x="0" y="3.077" width="38" height="1.538" fill="#b22234"/><rect x="0" y="4.615" width="38" height="1.538" fill="#fff"/><rect x="0" y="6.154" width="38" height="1.538" fill="#b22234"/><rect x="0" y="7.692" width="38" height="1.538" fill="#fff"/><rect x="0" y="9.231" width="38" height="1.538" fill="#b22234"/><rect x="0" y="10.769" width="38" height="1.538" fill="#fff"/><rect x="0" y="12.308" width="38" height="1.538" fill="#b22234"/><rect x="0" y="13.846" width="38" height="1.538" fill="#fff"/><rect x="0" y="15.385" width="38" height="1.538" fill="#b22234"/><rect x="0" y="16.923" width="38" height="1.538" fill="#fff"/><rect x="0" y="18.462" width="38" height="1.538" fill="#b22234"/><rect x="0" y="0" width="15.2" height="10.769" fill="#3c3b6e"/><circle cx="1.40" cy="1.20" r="0.42" fill="#fff"/><circle cx="4.50" cy="1.20" r="0.42" fill="#fff"/><circle cx="7.60" cy="1.20" r="0.42" fill="#fff"/><circle cx="10.70" cy="1.20" r="0.42" fill="#fff"/><circle cx="13.80" cy="1.20" r="0.42" fill="#fff"/><circle cx="2.95" cy="2.72" r="0.42" fill="#fff"/><circle cx="6.05" cy="2.72" r="0.42" fill="#fff"/><circle cx="9.15" cy="2.72" r="0.42" fill="#fff"/><circle cx="12.25" cy="2.72" r="0.42" fill="#fff"/><circle cx="1.40" cy="4.24" r="0.42" fill="#fff"/><circle cx="4.50" cy="4.24" r="0.42" fill="#fff"/><circle cx="7.60" cy="4.24" r="0.42" fill="#fff"/><circle cx="10.70" cy="4.24" r="0.42" fill="#fff"/><circle cx="13.80" cy="4.24" r="0.42" fill="#fff"/><circle cx="2.95" cy="5.76" r="0.42" fill="#fff"/><circle cx="6.05" cy="5.76" r="0.42" fill="#fff"/><circle cx="9.15" cy="5.76" r="0.42" fill="#fff"/><circle cx="12.25" cy="5.76" r="0.42" fill="#fff"/><circle cx="1.40" cy="7.28" r="0.42" fill="#fff"/><circle cx="4.50" cy="7.28" r="0.42" fill="#fff"/><circle cx="7.60" cy="7.28" r="0.42" fill="#fff"/><circle cx="10.70" cy="7.28" r="0.42" fill="#fff"/><circle cx="13.80" cy="7.28" r="0.42" fill="#fff"/><circle cx="2.95" cy="8.80" r="0.42" fill="#fff"/><circle cx="6.05" cy="8.80" r="0.42" fill="#fff"/><circle cx="9.15" cy="8.80" r="0.42" fill="#fff"/><circle cx="12.25" cy="8.80" r="0.42" fill="#fff"/><circle cx="1.40" cy="10.32" r="0.42" fill="#fff"/><circle cx="4.50" cy="10.32" r="0.42" fill="#fff"/><circle cx="7.60" cy="10.32" r="0.42" fill="#fff"/><circle cx="10.70" cy="10.32" r="0.42" fill="#fff"/><circle cx="13.80" cy="10.32" r="0.42" fill="#fff"/></svg></h1>
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

      <article class="lang-ru" lang="ru" data-lang-block="ru">
        <h2>О нас<svg class="flag" viewBox="0 0 30 20" width="20" height="13" aria-hidden="true"><rect width="30" height="20" fill="#fff"/><rect y="6.667" width="30" height="6.667" fill="#0039a6"/><rect y="13.333" width="30" height="6.667" fill="#d52b1e"/><rect x="0" y="0" width="30" height="20" fill="none" stroke="rgba(0,0,0,.18)" stroke-width="0.6"/></svg></h2>
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