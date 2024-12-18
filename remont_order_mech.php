<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница механика</title>
    <!-- Подключение стилей, скриптов и библиотек (например, jQuery) -->
    <style>body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

        </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<h1>Текущие ремонты</h1>

<table id="repairsTable">
    <!-- Таблица с текущими ремонтами будет отображаться здесь -->
</table>

<script>
    $(document).ready(function() {
        var username = localStorage.getItem('username');

        if (username) {
            loadRepairs(username);
        } else {
            alert('Имя пользователя не найдено в localStorage.');
        }

        $(document).on('click', '.acceptOrderBtn', function() {
            var repair_id = $(this).data('repair_id');

            // Перенаправляем на страницу с формой при клике на кнопку
            window.location.href = 'form_page_mech.php?repair_id=' + repair_id;
        });

        function loadRepairs(username) {
            $.ajax({
                type: 'POST',
                url: 'get_repairs_for_mechanic.php',
                data: { username: username },
                dataType: 'html',
                success: function(response) {
                    $('#repairsTable').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Произошла ошибка при загрузке данных.');
                }
            });
        }
    });
</script>

</body>
</html>
