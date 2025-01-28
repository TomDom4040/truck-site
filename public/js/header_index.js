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