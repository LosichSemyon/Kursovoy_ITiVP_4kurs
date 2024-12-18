document.addEventListener("DOMContentLoaded", function() {
    var usernameField = document.getElementById("username");
    var emailField = document.getElementById("email");
    var passwordField = document.getElementById("password");
    var confirmPasswordField = document.getElementById("confirm_password");
    var messageContainer = document.getElementById("message-container"); // Элемент для вывода сообщений
    var loader = document.getElementById("loader"); // Элемент для анимации крутящегося колеса

    document.querySelector("form").onsubmit = function(event) {
        event.preventDefault();

        // Скрыть сообщения об ошибках и показать крутящееся колесо
        messageContainer.style.display = "none";
        loader.style.display = "none";

        // AJAX запрос к серверу
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register_process.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            // Скрыть крутящееся колесо и показать сообщения об ошибках/успешной регистрации
            loader.style.display = "none";
            messageContainer.style.display = "none";

            var response = JSON.parse(this.responseText);

            if (response.username_error) {
                usernameField.style.border = "2px solid red";
                loader.style.display = "none";
                alert(response.username_error);
            }

            if (response.email_error) {
                emailField.style.border = "2px solid red";
                loader.style.display = "none";
                alert(response.email_error);
            }

            if (response.password_error) {
                passwordField.style.border = "2px solid red";
                confirmPasswordField.style.border = "2px solid red";
                loader.style.display = "none";
                alert(response.password_error);
            }

            if (response.success) {
                // Показать сообщение об успешной регистрации
               loader.style.display = "block";
               messageContainer.innerText = response.success;
                // Редирект на страницу с предложением авторизироваться через 2 секунды
                setTimeout(function() {
                    
                    window.location.href = "registration_succes.php";
                }, 2000);
               
            }
        };
        
        xhr.send("username=" + usernameField.value + "&email=" + emailField.value + "&password=" + passwordField.value + "&confirm_password=" + confirmPasswordField.value);
    };
    loader.style.display ="none";
});

