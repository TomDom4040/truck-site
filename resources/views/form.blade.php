<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <!-- Страница не масштабируется: двойной тап больше не увеличивает.
       touch-action:manipulation — это как раз то, что понимает Safari на айфоне
       (сам по себе user-scalable=no он игнорирует). -->
  <style>html{ touch-action: manipulation; -webkit-text-size-adjust: 100%; }</style>
  <title>Request Repair Cost - Mobile Truck Repair</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20260813l.css">
<body class="page-wrap">
  @include('partials.header')

  <main class="page-body">
    <div class="container">
      <div class="legacy-form">
        @php
          $html = file_get_contents(public_path('form.html'));
          // снять оболочку и встроенные стили
          $html = preg_replace('~<!DOCTYPE.*?>|</?html.*?>|<head[\s\S]*?</head>|</?body.*?>~i', '', $html);
          $html = preg_replace('~<(header|footer|nav)[\s\S]*?</\1>~i', '', $html);
          // В form.html теги <meta> и <title> лежат БЕЗ <head>, поэтому правило выше
          // их не снимало. Свой viewport оттуда переопределял наш и возвращал
          // масштабирование страницы — вырезаем их отдельно.
          $html = preg_replace('~<meta[^>]*>|<title[\s\S]*?</title>~i', '', $html);
          $html = preg_replace('~<style[\s\S]*?</style>~i', '', $html);

          // убрать кнопку "Back to Main Page" в любом виде
          $html = preg_replace('~<(a|button)[^>]*>\s*Back\s*to\s*Main\s*Page\s*</\1>~i', '', $html);
          $html = preg_replace('~<div[^>]*>\s*(Back\s*to\s*Main\s*Page)\s*</div>~i', '', $html);

          echo $html;
        @endphp
      </div>
    </div>
  </main>

  @include('partials.footer')
</body>
</html>