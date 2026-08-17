<!-- Blue sticky header -->
<style>
  /* Надпись на месте бывшей красной кнопки (только на главной).
     Отступы те же, что были у кнопки, — соседние элементы шапки не съезжают. */
  /* Меню на телефоне — маленькое окошко под кнопкой MENU, а не полоса во всю ширину */
  .header{ position: relative; }
  .menu-pop{
    position: absolute; right: 10px; top: calc(100% + 8px);
    display: none; z-index: 60;
    min-width: 220px; padding: 6px;
    background: #fff; border-radius: 12px;
    box-shadow: 0 12px 30px rgba(0,0,0,.28);
  }
  .menu-pop.open{ display: block; }
  .menu-pop a{
    display: flex; align-items: center; gap: 12px;
    padding: 12px; border-radius: 8px;
    color: #23282d; text-decoration: none; font-weight: 600; font-size: 16px;
  }
  .menu-pop a + a{ border-top: 1px solid #edeff2; }
  .menu-pop a:active{ background: #f2f5f7; }
  .menu-pop i{ width: 20px; text-align: center; color: #17739c; font-size: 17px; }
  /* значки у пунктов в синей строке */
  .main-nav a i{ margin-right: 8px; }
  @media (min-width: 768px){ .menu-pop{ display: none !important; } }

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
    font-size: 18px;
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
    @if (request()->is('/'))
      {{-- Главная: два пункта со значками. На компьютере они всегда в синей строке,
           на телефоне — в окошке под кнопкой MENU (см. ниже). --}}
      <nav class="main-nav" aria-label="Primary">
        <a href="/about" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;">
          <i class="fa-solid fa-circle-info" aria-hidden="true"></i><span data-i18n="nav.about">About Us</span>
        </a>
        <a href="#services" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;">
          <i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i><span data-i18n="nav.ourServices">Our Services</span>
        </a>
        <a href="#contact" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;">
          <i class="fa-solid fa-phone" aria-hidden="true"></i><span data-i18n="nav.ourContacts">Our Contacts</span>
        </a>
      </nav>
    @else
      <nav class="main-nav" aria-label="Primary">
        <a href="/" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.home">Home</a>
        <a href="/about" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.about">About Us</a>
        <a href="/#services" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.services">Services</a>
        <a href="/#contact" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;" data-i18n="nav.contact">Contact Us</a>
      </nav>
    @endif
    <button class="menu-btn" id="menuBtn" aria-expanded="false" aria-controls="mobileMenu" data-i18n="nav.menu">MENU</button>
  </div>

  @if (request()->is('/'))
    {{-- Окошко живёт внутри .header: от него и считается его положение --}}
  <div class="menu-pop" id="mobileMenu">
    <a href="/about"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span data-i18n="nav.about">About Us</span></a>
    <a href="#services"><i class="fa-solid fa-screwdriver-wrench" aria-hidden="true"></i><span data-i18n="nav.ourServices">Our Services</span></a>
    <a href="#contact"><i class="fa-solid fa-phone" aria-hidden="true"></i><span data-i18n="nav.ourContacts">Our Contacts</span></a>
  </div>
  @endif
</div>

<!-- Mobile menu -->
@if (!request()->is('/'))
<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-inner content-row" style="flex-direction:column; gap:8px; align-items:stretch;">
    <a href="/"        style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.home">Home</a>
    <a href="/about"   style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.about">About Us</a>
    <a href="/#services"style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.2);" data-i18n="nav.services">Services</a>
    <a href="/#contact" style="color:#fff; text-decoration:none; font-weight:700; padding:8px 0;" data-i18n="nav.contact">Contact Us</a>
  </div>
</div>@endif

<script>
  // Окошко меню закрывается тапом мимо него
  document.addEventListener('click', function (e) {
    var pop = document.querySelector('.menu-pop.open');
    if (!pop) return;
    if (pop.contains(e.target) || e.target.closest('#menuBtn')) return;
    pop.classList.remove('open');
    var btn = document.getElementById('menuBtn');
    if (btn) btn.setAttribute('aria-expanded', 'false');
  });
</script>
