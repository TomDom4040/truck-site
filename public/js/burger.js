document.addEventListener('DOMContentLoaded', function() {
    const burgerMenuContent = document.querySelector('.burger_menu_content');
    const closeBurgerButton = document.querySelector('.close_burger');
    const burgerMenuButton = document.querySelector('.burger_menu');
    const burgerMenuOverlay = document.createElement('div');

    // Создаем overlay для клика на пустое пространство
    burgerMenuOverlay.classList.add('burger_menu_overlay');
    document.body.appendChild(burgerMenuOverlay);

    // Функция для открытия меню
    function openMenu() {
        burgerMenuContent.classList.add('active');
        burgerMenuOverlay.classList.add('active');
        document.body.classList.add('no-scroll'); // Запрет скролла
    }

    // Функция для закрытия меню
    function closeMenu() {
        burgerMenuContent.classList.remove('active');
        burgerMenuOverlay.classList.remove('active');
        document.body.classList.remove('no-scroll'); // Разрешить скролл
    }

    // Открытие меню по кнопке "Бургер"
    burgerMenuButton.addEventListener('click', openMenu);

    // Закрытие меню при клике на кнопку "Закрыть"
    closeBurgerButton.addEventListener('click', closeMenu);

    // Закрытие меню при клике на overlay
    burgerMenuOverlay.addEventListener('click', closeMenu);

    // Закрытие меню при свайпе вверх
    let startY = 0;

    burgerMenuContent.addEventListener('touchstart', (e) => {
        startY = e.touches[0].clientY;
    });

    burgerMenuContent.addEventListener('touchmove', (e) => {
        const endY = e.touches[0].clientY;

        if (startY - endY > 50) {
            // Если свайп вверх превышает 50px
            closeMenu();
        }
    });
});