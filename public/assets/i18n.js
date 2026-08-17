/**
 * Переключение языка сайта (Ru / En) без перезагрузки страницы.
 *
 * Как устроено: английский текст лежит прямо в разметке — он и есть исходный.
 * Русский берётся из словаря ниже по ключу в атрибуте data-i18n. При первом
 * переключении оригинал запоминается в самом элементе, поэтому обратно на
 * английский возвращаемся точь-в-точь, без второго словаря.
 *
 * Что НЕ переводится (сознательно): адреса, телефон, почта, название компании
 * и любые надписи, вшитые в картинки.
 *
 * Выбор языка хранится в localStorage и действует на всех страницах сайта.
 */
(function () {
  var KEY = 'site_lang';

  var RU = {
    // шапка
    'nav.home':      'На главную',
    'nav.about':     'О нас',
    'nav.services':  'Услуги',
    'nav.contact':   'Контакты',
    'nav.menu':      'МЕНЮ',
    'nav.ourServices': 'Наши услуги',
    'nav.ourContacts': 'Наши контакты',
    'cta.request':   'Рассчитать стоимость',

    // главная
    'home.location': 'Адрес:',
    'home.call':     'Позвонить:',
    'home.services': 'Наши услуги:',

    // подвал
    'footer.tagline':    'Ремонт траков, пикапов и трейлеров в Лос-Анджелесе',
    'footer.diag':       'Диагностика',
    'footer.dpf':        'Обслуживание DPF',
    'footer.electrical': 'Ремонт электрики',
    'footer.oil':        'Замена масла',
    'footer.brakes':     'Ремонт тормозов',
    'footer.air':        'Ремонт пневмосистемы',
    'footer.contacts':   'Наши контакты:',
    'footer.phone':      'Телефон',
    'footer.by':         'Сайт создан компанией ElkaClub',

    // страница формы
    'form.title':   'Заявка на ремонт',
    'form.q1':      '1) Укажите точный адрес, где нужен ремонт: *',
    'form.q2':      '2) Опишите поломку: *',
    'form.q3':      '3) Ваш email: *',
    'form.q4':      '4) Ваш телефон: *',
    'form.submit':  'Отправить',
    'form.ph2':     'Кратко опишите проблему...',
    'form.back':    'На главную',
    'form.sending': 'Отправляю…',
    'form.ok':      'Спасибо! Заявка отправлена.',
    'form.err':     'Сейчас отправить не удалось. Попробуйте ещё раз.'
  };

  function saved() {
    try { return localStorage.getItem(KEY); } catch (e) { return null; }
  }
  function remember(lang) {
    try { localStorage.setItem(KEY, lang); } catch (e) {}
  }

  /** Подменить текст элементов и подписи полей. */
  function apply(lang) {
    document.querySelectorAll('[data-i18n]').forEach(function (el) {
      if (el.dataset.i18nEn === undefined) el.dataset.i18nEn = el.textContent;
      var ru = RU[el.getAttribute('data-i18n')];
      el.textContent = (lang === 'ru' && ru) ? ru : el.dataset.i18nEn;
    });

    document.querySelectorAll('[data-i18n-ph]').forEach(function (el) {
      if (el.dataset.i18nPhEn === undefined) el.dataset.i18nPhEn = el.placeholder || '';
      var ru = RU[el.getAttribute('data-i18n-ph')];
      el.placeholder = (lang === 'ru' && ru) ? ru : el.dataset.i18nPhEn;
    });

    // Блоки, написанные сразу на двух языках (страница «О нас»):
    // показываем только тот, что выбран.
    document.querySelectorAll('[data-lang-block]').forEach(function (el) {
      el.hidden = (el.getAttribute('data-lang-block') !== lang);
    });

    document.documentElement.setAttribute('lang', lang);

    document.querySelectorAll('.lang-btn').forEach(function (b) {
      b.classList.toggle('on', b.getAttribute('data-lang') === lang);
    });
  }

  function setLang(lang) { remember(lang); apply(lang); }

  /**
   * Перевод для текстов, которые ставит скрипт (например надпись на кнопке
   * во время отправки формы). fallback — английский вариант из кода.
   */
  window.t = function (key, fallback) {
    return (saved() === 'ru' && RU[key]) ? RU[key] : fallback;
  };

  function init() {
    apply(saved() === 'ru' ? 'ru' : 'en');   // по умолчанию сайт английский
    document.querySelectorAll('.lang-btn').forEach(function (b) {
      b.addEventListener('click', function () { setLang(b.getAttribute('data-lang')); });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
