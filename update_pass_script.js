function validateForm() {
    var oldPassword = document.getElementById("old_password").value;
    var newPassword = document.getElementById("new_password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    var messageContainer = document.getElementById("message-container");
    messageContainer.innerHTML = ""; // Очищаем предыдущие сообщения

    // Дополнительные проверки
    if (oldPassword.length === 0) {
        displayErrorMessage("Введите старый пароль.");
        return false; // Отменяем отправку формы
    }

    // AJAX-запрос на сервер для проверки старого пароля
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_old_password.php", false); // Синхронный запрос, для примера. Рекомендуется использовать асинхронные запросы.

    // Отправляем данные на сервер
    var formData = new FormData();
    formData.append("old_password", oldPassword);
    xhr.send(formData);

    // Обработка ответа
    if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);

        if (!response.success) {
            displayErrorMessage("Введен неверный старый пароль.");
            return false; // Отменяем отправку формы
        }
    }

    // Проверка совпадения новых паролей
    if (newPassword !== confirmPassword) {
        displayErrorMessage("Новые пароли не совпадают. Попробуйте еще раз.");
        return false; // Отменяем отправку формы
    }

    // Здесь вы можете добавить дополнительные проверки для нового пароля

    return true; // Разрешаем отправку формы
}
function displayErrorMessage(message) {
    // Вместо добавления элемента в message-container используем alert
    alert(message);
}

