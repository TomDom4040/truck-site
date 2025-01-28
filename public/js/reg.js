document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("registration").addEventListener("submit", function(event) {
        event.preventDefault(); // Предотвращаем отправку формы

        const email = document.querySelector('input[name="email"]');
        const password = document.querySelector('input[name="password"]');
        const passwordConfirmation = document.querySelector('input[name="password_confirmation"]');
        const acceptTerms = document.getElementById('accept_terms');

        let isValid = true;

        // Очистить предыдущие ошибки
        document.getElementById("emailError").textContent = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("passwordConfirmationError").textContent = "";

        // Валидация email
        if (!email.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
            document.getElementById("emailError").textContent = "Неверный формат email";
            isValid = false;
        }

        // Валидация паролей
        if (password.value.length < 6) {
            document.getElementById("passwordError").textContent = "Пароль должен содержать не менее 6 символов";
            isValid = false;
        }

        if (password.value !== passwordConfirmation.value) {
            document.getElementById("passwordConfirmationError").textContent = "Пароли не совпадают";
            isValid = false;
        }

        // Проверка принятия условий
        if (!acceptTerms.checked) {
            alert("Вы должны принять условия соглашения");
            isValid = false;
        }

        // Если форма валидна, отправляем данные
        if (isValid) {
            // Убираем блокировку формы и отправляем ее
            event.target.submit();
        }
    });
});