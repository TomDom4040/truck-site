<!-- Site footer -->
<footer class="site-footer">
  <div class="footer-inner">
    <!-- 1. Название и описание -->
    <section>
      <h3 class="footer-title">Profi Truck Repair Service</h3>
      <p class="footer-text" data-i18n="footer.tagline">Truck, pickup and trailer repair in Los Angeles</p>
    </section>

    <!-- 3. Контакты: номер и почта не переводим, только подписи -->
    <section id="contact">
      <h3 class="footer-title" data-i18n="footer.contacts">Our Contacts:</h3>
      <div class="footer-contact">
        <div class="value">
          <span data-i18n="footer.phone">Phone</span> ☎️
          <a class="footer-link" href="tel:+17473299691">(747) 329-9691</a>
        </div>
        <div class="value">
          email: <a class="footer-link" href="mailto:profitruckrepaillc@gmail.com">profitruckrepaillc@gmail.com</a>
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
  .site-footer .footer-inner{ align-items: flex-start; }        /* колонки выравниваем по верху */
  .footer-icon-row{ display:flex; }
  .footer-social{ justify-content:center; gap:20px; margin:18px 0 12px; font-size:20px; }
  .site-footer .footer-bottom{ text-align:center; padding:0 12px; font-size:14px; opacity:.85; }
  .site-footer .footer-contact .value{ margin-bottom:6px; overflow-wrap:anywhere; }  /* длинная почта не вылезает за край */
  .site-footer .footer-title{ margin:0 0 8px; font-size:17px; }
  .site-footer .footer-list{ list-style:none; margin:0; padding:0; }
  .site-footer .footer-list li{ margin-bottom:4px; }
  .site-footer .footer-text{ margin:0; }
</style>

<script src="/assets/i18n.js?v=8"></script>

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