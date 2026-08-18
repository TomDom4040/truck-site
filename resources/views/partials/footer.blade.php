@if (!request()->is('about'))
<!-- Site footer -->
<footer class="site-footer">
  <div class="footer-inner">
    <!-- 1. Название и описание -->
    <section>
      <h3 class="footer-title"><span data-i18n="footer.weAre">We are</span> PROFI TRUCK REPAIR LLC</h3>
      <p class="footer-text">
        {{-- вторая строка отдельным переводом: перенос должен остаться в обоих языках --}}
        <span data-i18n="footer.tagline">Truck, pickup and trailer repair</span><br>
        <span data-i18n="footer.tagline2">in Los Angeles, Commerce, California</span>
      </p>
    </section>

    <!-- 3. Контакты: номер и почта не переводим, только подписи -->
    <section id="contact">
      <h3 class="footer-title" data-i18n="footer.contacts">Our Contacts:</h3>
      <div class="footer-contact">
        <div class="value">
          ☎️ <span data-i18n="footer.phone">Phone:</span>
          <a class="footer-link" href="tel:+17473299691">(747) 329-9691</a>
        </div>
        <div class="value">
          <svg class="mail-ico" width="19" height="19" viewBox="0 0 24 24" fill="#e2574c" aria-hidden="true"><path d="M2 5.5A1.5 1.5 0 0 1 3.5 4h17A1.5 1.5 0 0 1 22 5.5v.4l-10 5.6L2 5.9v-.4z"/><path d="M22 8.2V18a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.2l9.5 5.3a1 1 0 0 0 1 0L22 8.2z"/></svg> email: <a class="footer-link" href="mailto:profitruckrepaillc@gmail.com">profitruckrepaillc@gmail.com</a>
        </div>
        <div class="value">
          📍 <span data-i18n="footer.addr">Our address:</span> 5800 Sheila St, Commerce, CA
        </div>
      </div>
    </section>
  </div>

  <!-- Соцсети — под колонками, над самой нижней строкой -->
  <div class="footer-icon-row footer-social">
    <a class="footer-icon" href="https://www.facebook.com/groups/1061231975929415/?ref=share_group_link&mibextid=wwXIfr" aria-label="Facebook" target="_blank">
      <i class="fab fa-facebook"></i>
    </a>
    <a class="footer-icon" href="https://www.instagram.com/car_mats_pro?igsh=NTc4MTIwNjQ2YQ==" aria-label="Instagram" target="_blank">
      <i class="fab fa-instagram"></i>
    </a>
    <a class="footer-icon" href="https://chat.whatsapp.com/H6x5CyGLMSD6oUa3UmopQo?mode=ac_t" aria-label="WhatsApp" target="_blank">
      <i class="fab fa-whatsapp"></i>
    </a>
    <a class="footer-icon" href="https://t.me/Trucks_job" aria-label="Telegram" target="_blank">
      <i class="fab fa-telegram"></i>
    </a>
  </div>

  <div class="footer-bottom" data-i18n="footer.by">Website by ElkaClub</div>
</footer>

<style>
  /* У этих классов в общем CSS правил нет — оформляем здесь. */
  .site-footer .footer-inner{
    align-items: flex-start;   /* колонки выравниваем по верху */
    gap: 30px;                 /* воздух между описанием и контактами */
  }
  .footer-icon-row{ display:flex; }
  .footer-social{ justify-content:center; gap:20px; margin:32px 0 12px; font-size:20px; }  /* отступ от контактов до иконок */
  .site-footer .footer-bottom{ text-align:center; padding:0 12px; font-size:14px; opacity:.85; }
  /* запас под строкой создателя: на айфоне учитываем ещё и системную полосу снизу */
  /* Запас снизу: на телефоне поверх страницы всплывает панель браузера
     и раньше накрывала нижнюю строку. env(...) добавляет системную полосу iPhone. */
  .site-footer{ padding-bottom: calc(104px + env(safe-area-inset-bottom)) !important; }
  /* На широком экране колонки сдвигаем сильнее: там есть запас.
     До 1400px оставляем 96px — иначе строка «в Лос-Анджелесе…» ломается на три. */
  @media (min-width: 1400px){
    .site-footer .footer-inner > section:first-child{ padding-left: 210px !important; }
    .site-footer .footer-inner > section:last-child{ padding-left: 150px !important; }
  }
  @media (min-width: 768px){
    .site-footer{ padding-bottom: 44px !important; }   /* на компьютере столько не нужно */
    /* Колонки подвала повторяют разметку страницы: левая начинается ровно там же,
       где левый край карты, правая — там же, где серые плашки. Тогда контакты
       не вылезают за правый край картинки с траком. */
    /* у main те же 12px по краям — повторяем их, иначе подвал стоит на 12px левее */
    .site-footer{ padding-inline: 12px; }
    /* обе колонки сдвинуты внутрь своей ячейки */
    .site-footer .footer-inner > section:first-child{ padding-left: 96px !important; }
    /* контакты чуть правее: просто отступ внутри своей колонки */
    .site-footer .footer-inner > section:last-child{ padding-left: 96px !important; }
    .site-footer .footer-inner{
      display: grid;
      grid-template-columns: 1fr 1fr;
      column-gap: 21px;
      /* Те же рамки, что у содержимого страницы: полоса подвала во всю ширину,
         а сам текст — в коробке 1200px по центру, с отступом 12px, как у картинок.
         Без max-width на широком мониторе текст уезжал к краям экрана. */
      max-width: 1200px;
      margin-inline: auto;
      padding-left: 12px !important;
      padding-right: 12px !important;
    }
  }
  .site-footer .footer-contact .value{ margin-bottom:6px; overflow-wrap:anywhere; }  /* длинная почта не вылезает за край */
  .site-footer .footer-title{ margin:0 0 8px; font-size:17px; }
  /* Конверт рисуем сами: эмодзи 📧 на тёмном фоне блёклый и теряется
     рядом с красными ☎️ и 📍. Цвет взят из них же. */
  .mail-ico{ display:inline-block; vertical-align:-3px; }
  .site-footer .footer-list{ list-style:none; margin:0; padding:0; }
  .site-footer .footer-list li{ margin-bottom:4px; }
  .site-footer .footer-text{ margin:0; }
</style>

@endif

<script src="/assets/i18n.js?v=14"></script>

<!-- Shared JS (mobile menu + year) -->
<script>
  (function () {
    // Страница всегда открывается сверху: браузер не восстанавливает прежнюю
    // прокрутку, а якорь в адресе (после тапа по «Our Services») не утаскивает
    // в подвал при обновлении.
    if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
    if (!location.hash) window.addEventListener('load', function () { window.scrollTo(0, 0); });
    // Пришли по ссылке с якорем (например «Our Services» с другой страницы) —
    // доезжаем до нужного блока и сразу чистим адрес: следующее обновление
    // страницы снова откроет её сверху.
    if (location.hash) {
      var target = document.getElementById(location.hash.slice(1));
      history.replaceState(null, '', location.pathname + location.search);
      if (target) {
        window.addEventListener('load', function () {
          target.scrollIntoView({ block: 'start' });
        });
      } else {
        window.scrollTo(0, 0);
      }
    }

    // Ссылки-якоря прокручивают плавно и НЕ оставляют # в адресе,
    // иначе следующее обновление снова прыгнет туда.
    document.addEventListener('click', function (e) {
      var a = e.target.closest('a[href^="#"]');
      if (!a) return;
      var target = document.getElementById(a.getAttribute('href').slice(1));
      if (!target) return;
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      var pop = document.querySelector('.menu-pop.open');
      if (pop) pop.classList.remove('open');
    });

    const btn  = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    if (btn && menu) {
      btn.addEventListener('click', function () {
        const isOpen = menu.classList.toggle('open');
        btn.setAttribute('aria-expanded', String(isOpen));
      });
    }
    var y = document.getElementById('y');
    if (y) y.textContent = new Date().getFullYear();
  })();
</script>