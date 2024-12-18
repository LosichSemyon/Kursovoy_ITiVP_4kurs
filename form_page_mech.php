<!-- form_page.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма ввода цены</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

        </style>
</head>
<body>

<?php
// Получаем repair_id из URL
$repair_id = isset($_GET['repair_id']) ? $_GET['repair_id'] : null;

if (!$repair_id) {
    echo 'Ошибка: Не передан repair_id.';
    exit;
}
?>
  <div class="container">
        <h2>введите цену для заказа <?php echo $repair_id; ?></h2>
        <label for="price">Цена:</label>
        <input type="text" id="price" name="price" required>
        <br>
        <button type="button" onclick="submitForm()">Отправить</button>
    </div>
<script>
    function submitForm() {
        var price = $('#price').val();
        var repair_id = <?php echo $repair_id; ?>;

        if (!price) {
            alert('Пожалуйста, введите цену.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'order_confirm_mech1.php',
            data: {
                repair_id: repair_id,
                price: price
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                  window.location.href = 'remont_order_mech.php';
                    // Дополнительные действия после успешного сохранения данных, если необходимо
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Произошла ошибка при выполнении запроса.');
            }
        });
    }
</script>

</body>
</html>
