document.addEventListener('DOMContentLoaded', function() {
    // Обработка табов
    const tabs = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(tab => tab.classList.remove('active'));
            tab.classList.add('active');

            const targetTab = document.getElementById(tab.dataset.tab);
            tabContents.forEach(content => content.classList.remove('active'));
            targetTab.classList.add('active');
        });
    });

    // Обработка отправки формы для получения кода
    const emailForm = document.getElementById('email-form');
    emailForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Предотвращаем перезагрузку страницы

        const formData = new FormData(emailForm); // Получаем все данные формы

        fetch(emailForm.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                // Проверяем, является ли ответ JSON
                if (!response.ok) {
                    throw new Error('Сервер вернул ошибку: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Скрыть поля для ввода email и пароля
                    document.getElementById('email-fields').style.display = 'none';

                    // Показать форму для ввода кода
                    document.getElementById('verification-form-container').style.display = 'block';
                } else {
                    // Показать ошибку, если код не был отправлен
                    alert(data.error || 'Произошла ошибка');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Что-то пошло не так');
            });
    });
});