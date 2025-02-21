$(document).ready(function() {
    const $swipeHeader = $('.swipe_header_main');
    const $headerMain = $('.header_main');

    let isSwipeHeaderVisible = true; // Флаг для состояния swipeHeader
    let lastScrollTop = 0; // Последнее положение скролла
    let isAnimating = false; // Флаг для предотвращения дерганий

    // Функция для скрытия swipeHeader
    function hideSwipeHeader() {
        if (!isSwipeHeaderVisible || isAnimating) return; // Уже скрыт или в процессе анимации
        isSwipeHeaderVisible = false;
        isAnimating = true;

        $swipeHeader.css({
            transition: 'transform 0.6s ease-out',
            transform: 'translateY(-100%)',
        });

        setTimeout(() => {
            $swipeHeader.hide();
            isAnimating = false;
        }, 600); // Убираем после завершения анимации
    }

    // Функция для отображения swipeHeader
    function showSwipeHeader() {
        if (isSwipeHeaderVisible || isAnimating) return; // Уже виден или в процессе анимации
        isSwipeHeaderVisible = true;
        isAnimating = true;

        $swipeHeader
            .show()
            .css({ transform: 'translateY(-100%)' }) // Начальная позиция
            .delay(10)
            .queue(function(next) {
                $(this).css({
                    transition: 'transform 0.6s ease-out',
                    transform: 'translateY(0)',
                });
                next();
            });

        setTimeout(() => {
            isAnimating = false;
        }, 600); // Сбрасываем флаг после завершения анимации
    }

    // Обработчик скролла
    $(window).on('scroll', function() {
        let scrollTop = $(this).scrollTop();

        if (scrollTop > lastScrollTop) {
            // Скролл вниз — скрыть
            hideSwipeHeader();
            $headerMain.css({
                position: 'fixed',
                top: '0',
                width: '100%',
                zIndex: '1000',
                height: '45px',
            });
        } else {
            // Скролл вверх — показать только если на самом верху
            if (scrollTop === 0) {
                showSwipeHeader();
                $headerMain.css({
                    position: 'relative',
                    height: 'auto',
                });
            }
        }

        lastScrollTop = scrollTop;
    });

    // Обработчик клика по кнопке
    $('.btn_swipe').on('click', function() {
        hideSwipeHeader();
    });
});

document.querySelectorAll('.share-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        var adLink = button.getAttribute('data-ad-link');

        // Копирование полной ссылки с доменом в буфер обмена
        navigator.clipboard.writeText(adLink)
            .then(function() {
                var message = document.getElementById('copy-message');
                message.style.display = 'block';
                message.classList.add('show');

                setTimeout(function() {
                    message.classList.remove('show');
                    message.style.display = 'none';
                }, 2000); // 2 секунды для отображения сообщения
            })
            .catch(function(err) {
                alert('Не удалось скопировать ссылку. Попробуйте снова!');
            });
    });
});
// Плавный свайп к объявлению при наличии якоря
if (window.location.hash) {
    const hash = window.location.hash;
    const targetElement = document.querySelector(hash);

    if (targetElement) {
        const targetPosition = targetElement.offsetTop - 100; // Смещение для фиксированного меню
        const startPosition = window.pageYOffset; // Текущая позиция страницы
        const distance = targetPosition - startPosition; // Разница между текущей и целевой позицией
        const duration = 3000; // Время анимации в миллисекундах (3 секунды)
        let startTime = null;

        // Функция для анимации скроллинга
        function animateScroll(currentTime) {
            if (startTime === null) startTime = currentTime; // Сохраняем начальное время анимации
            const timeElapsed = currentTime - startTime; // Время, прошедшее с начала анимации
            const progress = Math.min(timeElapsed / duration, 1); // Прогресс анимации (нормализованный)

            // Рассчитываем текущую позицию в зависимости от прогресса
            const scrollTo = startPosition + distance * progress;

            window.scrollTo(0, scrollTo); // Прокручиваем страницу

            if (timeElapsed < duration) {
                requestAnimationFrame(animateScroll); // Повторяем анимацию, если время не вышло
            }
        }

        // Запуск анимации
        requestAnimationFrame(animateScroll);
    }
}