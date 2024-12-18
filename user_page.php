<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="styles/profile.css">
</head>

<body>
    <div class="container">
        <div class="profile-container">
            <div class="profile-info">
                <img src="media/logo.jpg" alt="Profile Image" class="profile-image">
                <p class="login-caption">Пользователь: <strong id="username"></strong> (Роль: <span id="role"></span>)</p>

                <!-- Добавленные кнопки -->
                <div class="profile-buttons">
                    <a href="index.php" class="profile-button">Выход из профиля</a>
                    <a href="upload_avatar.php" class="profile-button">Настройки</a>
                </div>
            </div>

            <div class="menu">
                <ul id="menu-list">
                    <li id="adminLink" style="display: none;"></li>
                    <li id="managerLink" style="display: none;"></li>
                    <li id="mechanicLink" style="display: none;"></li>
                    <li id="userLink" style="display: none;"></li>
                    <li><a onclick="loadPage('page1.php', 'Главная')">Главная</a></li>
                    <!-- Добавленные ссылки в зависимости от роли -->
                    
                </ul>
            </div>
        </div>
        <div class="page-container">
            <!-- Здесь будет отображаться содержимое страниц, выбранных в меню -->
            <iframe id="iframeContainer" width="100%" height="100%" frameborder="0"></iframe>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Получаем имя пользователя из localStorage
            var storedUsername = localStorage.getItem("username");
            // Получаем роль пользователя из localStorage
            var storedRole = localStorage.getItem("role");

            // Обновляем роль пользователя на странице
            if (storedRole) {
                document.getElementById("role").innerText = storedRole;

                

                // Проверяем роль пользователя и отображаем соответствующие ссылки в меню
                if (storedRole === "admin") {
                    document.getElementById("adminLink").style.display = "block";
                    addLinksToMenu("admin", [
                        { url: "uslugi_view.php", name: "Работа с услугами" },
                        { url: "role/role_main.php", name: "Установка ролей"},
                        { url: "admin_fun/deleteUserAdminMain.php", name: "Удаление аккаунтов" },
                        { url: "exel_exp_err.php", name: "Добавление ошибок" },
                        { url: "car_admin_view.php", name: "Автомобили в системе" },
                        { url: "otzivi_main.php", name: "Работа с отзывами" },
                        { url: "otobr_ist_admins.php", name: "История ремонтов" },
                        { url: "tekuhie_rem_admink.php", name: "Текущие ремонты" }
                    ]); // Добавляем ссылки для админа
                }else if (storedRole === "client") {
                    document.getElementById("managerLink").style.display = "block";
                    addLinksToMenu("manager", [
                        { url: "katalog_user.php", name: "Каталог деталей" },
                        { url: "uslugi_view.php", name: "Каталог услуг" },
                        { url: "car_user_view.php", name: "Мои автомобили" },
                        { url: "remont_order_client.php", name: "Мои ремонты" },
                        { url: "otzivi_main.php", name: "Оценки и отзывы" },
                        { url: "otobr_ist_client.php", name: "История ремонтов" }
                    ]); // Добавляем ссылки для менеджера
                }
                 else if (storedRole === "manager") {
                    document.getElementById("managerLink").style.display = "block";
                    addLinksToMenu("manager", [
                        { url: "uslugi_view.php", name: "Работа с услугами" },        
                        { url: "manager_catalog.php", name: "Редактирование каталога" },
                        { url: "manager_dashboard.php", name: "Пригласить на ремонт" },
                        { url: "analitica_main.php", name: "Аналитика склада" },
                        { url: "otzivi_main.php", name: "Работа с отзывами" },
                        { url: "otobr_ist_manager.php", name: "История ремонтов" }
                    ]); // Добавляем ссылки для менеджера
                } else if (storedRole === "mekchanic") {
                    document.getElementById("mechanicLink").style.display = "block";
                    addLinksToMenu("mechanic", [
                        { url: "http://localhost:8080/lab3q/kurs.html", name: "OBD" },
                        { url: "remont_order_mech.php", name: "Заказы на ремонт" },
                        { url: "otobr_ist_mech.php", name: "История ремонтов" }
                    ]); // Добавляем ссылки для механика
                } else {
                    document.getElementById("userLink").style.display = "block";
                    addLinksToMenu("user", [
                        { url: "unset.php", name: "А что делать?" }
                    ]); // Добавляем ссылки для обычного пользователя
                }
            }

            // Функция для добавления ссылок в меню```html
       // Функция для добавления ссылок в меню
       function addLinksToMenu(role, links) {
            var menuList = document.getElementById("menu-list");
            var roleLink = document.createElement("li");
            roleLink.id = role + "Link";

            for (var i = 0; i < links.length; i++) {
                var link = document.createElement("a");
                link.href = "javascript:void(0);";
                link.textContent = links[i].name;
                link.setAttribute("onclick", "loadPage('" + links[i].url + "', '" + links[i].name + "')");
                roleLink.appendChild(link);
            }

            menuList.appendChild(roleLink);
        }

        
        // Загрузка имени пользователя из localStorage
        if (storedUsername) {
            document.getElementById("username").innerText = storedUsername;
        }
    });
        // Загрузка страницы в iframe
        function loadPage(url, pageTitle) {
            var iframeContainer = document.getElementById("iframeContainer");
            iframeContainer.src = url;
            iframeContainer.onload = function() {
                document.title = pageTitle;
            };
        }
   
    </script>
</body>

</html>