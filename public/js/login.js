document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Предотвращаем отправку формы для валидации

    // Получаем значения полей
    const email = document.querySelector('input[name="email"]');
    const password = document.querySelector('input[name="password"]');

    // Получаем элементы для отображения ошибок
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    let isValid = true;

    // Очистить предыдущие ошибки
    emailError.textContent = "";
    passwordError.textContent = "";

    // Валидация email
    const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    if (!emailPattern.test(email.value)) {
        emailError.textContent = "Неверный формат email";
        isValid = false;
    }

    // Валидация пароля
    if (password.value.length < 6) {
        passwordError.textContent = "Пароль должен содержать не менее 6 символов";
        isValid = false;
    }

    // Если форма валидна, отправляем ее
    if (isValid) {
        this.submit(); // Отправляем форму
    }
});