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
@php
  // Набор пунктов одинаковый на всех страницах, меняется только первый:
  // на главной он ведёт «О нас», на остальных страницах — обратно на главную.
  $isHome = request()->is('/');
  $navItems = [
    $isHome
      ? ['href' => '/about', 'icon' => 'fa-circle-info', 'key' => 'nav.about', 'en' => 'About Us']
      : ['href' => '/',      'icon' => 'fa-house',       'key' => 'nav.home',  'en' => 'Home'],
    ['href' => '#services', 'icon' => 'fa-screwdriver-wrench', 'key' => 'nav.ourServices', 'en' => 'Our Services'],
    ['href' => '#contact',  'icon' => 'fa-phone',              'key' => 'nav.ourContacts', 'en' => 'Our Contacts'],
  ];
@endphp
<div class="header">
  <div class="header-inner content-row">
    {{-- На главной вместо красной кнопки — надпись «Language:» с переключателем.
         На остальных страницах кнопка «Request Repair Cost». --}}
    @if ($isHome)
      <span class="lang-label">Language:</span>
      <span class="lang-switch">
        <button type="button" class="lang-btn" data-lang="ru">Ru</button>
        <button type="button" class="lang-btn" data-lang="en">En</button>
      </span>
    @else
      <a class="cta-btn" href="/form" data-i18n="cta.request">Request Repair Cost</a>
    @endif
    <div class="spacer"></div>

    {{-- На компьютере пункты всегда в синей строке --}}
    <nav class="main-nav" aria-label="Primary">
      @foreach ($navItems as $it)
        <a href="{{ $it['href'] }}" style="color:#fff; text-decoration:none; font-weight:700; margin:0 14px; letter-spacing:0.5px;">
          <i class="fa-solid {{ $it['icon'] }}" aria-hidden="true"></i><span data-i18n="{{ $it['key'] }}">{{ $it['en'] }}</span>
        </a>
      @endforeach
    </nav>

    <button class="menu-btn" id="menuBtn" aria-expanded="false" aria-controls="mobileMenu" data-i18n="nav.menu">MENU</button>
  </div>

  {{-- На телефоне те же пункты — в окошке под кнопкой MENU.
       Окошко лежит ВНУТРИ .header: от него считается его положение. --}}
  <div class="menu-pop" id="mobileMenu">
    @foreach ($navItems as $it)
      <a href="{{ $it['href'] }}"><i class="fa-solid {{ $it['icon'] }}" aria-hidden="true"></i><span data-i18n="{{ $it['key'] }}">{{ $it['en'] }}</span></a>
    @endforeach
  </div>
</div>

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
