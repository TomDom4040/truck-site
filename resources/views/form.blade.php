<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Request Repair Cost - Mobile Truck Repair</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20260813c.css">
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