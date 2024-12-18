<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ввод цены и даты завершения заказа</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<h1>Форма ввода цены и даты завершения заказа</h1>

<!-- Форма ввода -->
<form id="orderForm">
    <label for="price">Цена:</label>
    <input type="text" id="price" name="price" required>
    <br>
    <label for="completionDate">Дата завершения (ГГГГ-ММ-ДД):</label>
    <input type="text" id="completionDate" name="completionDate" required>
    <br>
    <button type="button" onclick="submitForm()">Отправить</button>
</form>

<script>
    function submitForm() {
        var price = $('#price').val();
        var completionDate = $('#completionDate').val();

        if (!price || !completionDate) {
            alert('Пожалуйста, заполните все поля.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'accept_order.php',
            data: {
                repair_id: <?php echo $_GET['repair_id']; ?>,
                price: price,
                completion_date: completionDate
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    // Дополнительные действия после успешного сохранения данных, если необходимо
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Произошла ошибка при выполнении запроса.');
            }
        });
    }
</script>

</body>
</html>
