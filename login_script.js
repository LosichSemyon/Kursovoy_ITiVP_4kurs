document.addEventListener("DOMContentLoaded", function() {
    var usernameField = document.getElementById("username");
    var passwordField = document.getElementById("password");
    var messageContainer = document.getElementById("message-container"); // Элемент для вывода сообщений

    document.querySelector("form").onsubmit = function(event) {
        event.preventDefault();

        // Сброс рамок ошибок и сообщений
        usernameField.style.border = "2px solid black";
        passwordField.style.border = "2px solid black";
        messageContainer.innerText = "";

        // AJAX запрос к серверу
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "login_process.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            var response = JSON.parse(this.responseText);

            if (response.hasOwnProperty("username_error")) {
                usernameField.style.border = "2px solid red";
                alert(response.username_error);
            } else if (response.hasOwnProperty("password_error")) {
                passwordField.style.border = "2px solid red";
                alert(response.password_error);
            } else if (response.hasOwnProperty("success")) {
                // Сохраняем имя пользователя в localStorage
                localStorage.setItem("username", response.username);
                // Сохраняем роль пользователя в localStorage
                localStorage.setItem("role", response.role);

                // Обновляем имя пользователя на странице
                usernameField.innerText = response.username;

                // Перенаправить пользователя на страницу пользователя
                window.location.href = "user_page.php";
            }
        };

        xhr.send("username=" + usernameField.value + "&password=" + passwordField.value);
    };


    // Получаем имя пользователя из localStorage
    var storedUsername = localStorage.getItem("username");

    // Обновляем имя пользователя на странице при загрузке
    if (storedUsername) {
        usernameField.innerText = storedUsername;
    }
    
    // Получаем роль пользователя из localStorage
    var storedRole = localStorage.getItem("role");

    // Обновляем роль пользователя на странице
    if (storedRole) {
        document.getElementById("role").innerText = storedRole;
    }
});