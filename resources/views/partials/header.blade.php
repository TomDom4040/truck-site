<!-- Blue sticky header -->
<style>
  /* Надпись на месте бывшей красной кнопки (только на главной).
     Отступы те же, что были у кнопки, — соседние элементы шапки не съезжают. */
  .lang-switch{ display:inline-flex; gap:6px; margin-left:-6px; }
  .lang-btn{
    font: inherit; font-weight:700; font-size:16px; line-height:1;
    color:#fff; background:transparent; cursor:pointer;
    border:1px solid rgba(255,255,255,.55); border-radius:6px; padding:8px 13px;
  }
  .lang-btn.on{ background:#fff; color:#17739c; border-color:#fff; }   /* выбранный язык */
  .lang-label{
    color: var(--text-on-dark, #fff);
    font-weight: 700;
    letter-spacing: .5px;
    padding: 8px 14px;   /* как у кнопки: текст стоит на том же месте, где стоял её текст */
    display: inline-block;
    white-space: nowrap;
  }
</style>
<div class="header">
  <div class="header-inner content-row">
    {{-- На главной вместо красной кнопки — надпись «language:».
         На остальных страницах кнопка «Request Repair Cost» осталась. --}}
    @if (request()->is('/'))
      <span class="lang-label">Language:</span>
      <span class="lang-switch">
        <button type="button" class="lang-btn" data-lang="ru">Ru</button>
        <button type="button" class="lang-btn" data-lang="en">En</button>
      </span>
    @else
      <a class="cta-btn" href="/form" data-i18n="cta.request">Request Repair Cost</a>
    @endif
    <div class="spacer"></div>
    <nav class="main-nav" aria-label="Primary">
      <a href="/" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.home">Home</a>
      <a href="/about" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.about">About Us</a>
      <a href="/#services" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.services">Services</a>
      <a href="/#contact" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.contact">Contact Us</a>
    </nav>
    <button class="menu-btn" id="menuBtn" aria-expanded="false" aria-controls="mobileMenu" data-i18n="nav.menu">MENU</button>
  </div>
</div>

<!-- Mobile menu -->
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-inner content-row" style="flex-direction:column; gap:8px; align-items:stretch;">
    <a href="/"        style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.home">Home</a>
    <a href="/about"   style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.about">About Us</a>
    <a href="/#services"style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.services">Services</a>
    <a href="/#contact" style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0;" data-i18n="nav.contact">Contact Us</a>
  </div>
</div>