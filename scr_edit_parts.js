// Функция для отправки запроса на сервер для обновления данных о запчасти
function updatePart(partId) {
    // Получение данных из формы
    const partName = document.getElementById('partName').value;
    const partDescription = document.getElementById('partDescription').value;
    const partPrice = document.getElementById('partPrice').value;
    const partStock = document.getElementById('partStock').value;

    // Отправка запроса на сервер
    fetch('update_part.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `partId=${partId}&partName=${partName}&partDescription=${partDescription}&partPrice=${partPrice}&partStock=${partStock}`,
    })
    .then(response => {
        if (response.ok) {
            // Если обновление прошло успешно, перенаправляем на страницу с таблицей
            window.location.href = 'manager_catalog.php';
        } else {
            // Если возникла ошибка, выводим ее в консоль
            response.text().then(errorMessage => {
                console.error('Ошибка при обновлении запчасти:', errorMessage);
            });
        }
    })
    .catch(error => console.error('Ошибка при отправке запроса:', error));
}
