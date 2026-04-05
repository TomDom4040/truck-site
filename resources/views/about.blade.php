<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us - Mobile Truck Repair</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/assets/app.20250823.css">
<style>
  /* Лок для About: убираем любые левые отступы/абзацные отступы */
  .about-page .container *{
    margin-left:0 !important;
    padding-left:0 !important;
    text-indent:0 !important;
  }
</style>
</head>
<body class="page-wrap about-page">
  @include('partials.header')

  <main class="page-body">
    <div class="container">
      <article>
        <h1>About Us</h1>
        <p>We are a professional mobile truck repair company serving Los Angeles and surrounding areas. Our team of experienced mechanics provides on-site diagnostics, brake repairs, electrical work, oil changes, and pneumatic system services.</p>
        <p>Our mission is to get you back on the road quickly, safely, and with reliable service you can trust.</p>
      </article>
    </div>
  </main>

  @include('partials.footer')
</body>
</html>