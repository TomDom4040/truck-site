<!-- Site footer -->
<footer class="site-footer">
  <div class="footer-inner">
    <!-- 1. Brand / description / socials -->
    <section>
      <h3 class="footer-title">LES Truck Repair Service</h3>
      <p class="footer-text">
        Mobile Semi-Truck, Pickup Truck &amp; Trailer Repair Service in Los Angeles area
      </p>
      <div class="footer-icon-row">
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
    </section>

    <!-- 2. Services -->
    <section>
      <h3 class="footer-title">Services</h3>
      <ul class="footer-list">
        <li>● Diagnostics</li>
        <li>● DPF Service</li>
        <li>● Electrical Repair</li>
        <li>• Oil Change</li>
        <li>• Brake Jobs</li>
        <li>• Air System Repair</li>
      </ul>
    </section>

    <!-- 3. Contacts -->
    <section>
      <h3 class="footer-title">Contact Info</h3>
      <div class="footer-contact">
        <div>
          <div class="label">Address</div>
          <div class="value">9250 Tujunga Ave<br>Sun Valley, CA 91352</div>
        </div>
        <div>
          <div class="label">Phone</div>
          <div class="value">
            <a class="footer-link" href="tel:+18184896181">818-423-6473</a><br>
          </div>
        </div>
        <div>
          <div class="label">E-mail</div>
          <div class="value">
            <a class="footer-link" href="mailto:people.us20@gmail.com.com">info@MobileTruckepair.com</a>
          </div>
        </div>
      </div>
    </section>

    <!-- 4. Newsletter -->
    <section>
      <h3 class="footer-title">Newsletter</h3>
      <p class="footer-text">Sign up to receive the latest news and special discounts.</p>
      <a class="footer-cta" href="#newsletter">Sign Up Now ▸</a>
    </section>
  </div>

  <div class="footer-bottom">
    Copyright © 2021–<span id="y"></span>. All rights reserved.
  </div>
</footer>

<!-- Shared JS (mobile menu + year) -->
<script>
  (function () {
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