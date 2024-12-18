document.addEventListener("DOMContentLoaded", function () {
    // При загрузке страницы получаем данные с сервера
    fetchPartsData();
});

// Функция для отправки запроса на сервер и получения данных о запчастях
function fetchPartsData() {
    fetch('server_catalog.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('partsTable').innerHTML = data;

            // Добавляем обработчики для кнопок сортировки
            document.getElementById('sortPrice').addEventListener('click', sortTableByPrice);
            document.getElementById('sortStock').addEventListener('click', sortTableByStock);
            
            // Добавляем обработчик для кнопки поиска
            document.getElementById('searchButton').addEventListener('click', searchParts);
        })
        .catch(error => console.error('Ошибка получения данных:', error));
}

// Глобальные переменные для отслеживания текущего порядка сортировки
let sortAscendingPrice = true;
let sortAscendingStock = true;

// Функция для отправки запроса на сервер и получения отсортированных данных о запчастях
function sortTable(column, sortOrder) {
    fetch('server_catalog.php?sortColumn=' + column + '&sortOrder=' + sortOrder)
        .then(response => response.text())
        .then(data => {
            document.getElementById('partsTable').innerHTML = data;
        })
        .catch(error => console.error('Ошибка получения данных:', error));
}


// Функция для сортировки таблицы по цене
function sortTableByPrice() {
    // Инвертируем текущий порядок сортировки
    sortAscendingPrice = !sortAscendingPrice;

    // Вызываем функцию сортировки и передаем имя столбца и порядок сортировки
    sortTable('part_price', sortAscendingPrice ? 'ASC' : 'DESC');
}


// Функция для сортировки таблицы по остаткам на складе
function sortTableByStock() {
    sortAscendingStock = !sortAscendingStock;
    sortTable('part_stock', sortAscendingStock ? 'ASC' : 'DESC');
}

// Функция для отправки запроса на сервер и получения данных о запчастях после поиска
// Функция для поиска запчастей
function searchParts() {
    // Получаем значения для поиска
    var searchSku = document.getElementById('searchSku').value;
    var searchName = document.getElementById('searchName').value;

    // Отправляем запрос на сервер с параметрами поиска
    fetch('server_catalog.php?searchSku=' + searchSku + '&searchName=' + searchName)
        .then(response => response.text())
        .then(data => {
            document.getElementById('partsTable').innerHTML = data;
        })
        .catch(error => console.error('Ошибка получения данных:', error));
}


// Функция для удаления запчасти
function deletePart(partId) {
    // Отправляем запрос на сервер для удаления запчасти с указанным ID
    fetch('delete_part_manager.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'partId=' + partId,
    })
    .then(response => {
        if (response.ok) {
            // Если удаление прошло успешно, перезагружаем таблицу
            fetchPartsData();
        } else {
            console.error('Ошибка при удалении запчасти');
        }
    })
    .catch(error => console.error('Ошибка при отправке запроса:', error));
}


// Функция для редактирования запчасти
function editPart(partId) {
    // Перенаправляем пользователя на страницу редактирования с указанием partId
    window.location.href = 'edit_part_man.php?partId=' + partId;
}

