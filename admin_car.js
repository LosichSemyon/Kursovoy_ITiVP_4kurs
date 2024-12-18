document.addEventListener("DOMContentLoaded", function () {
    showAll();
});

function deleteCar(vin_number) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_car.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Перезагружаем таблицу после удаления записи
            reloadCarTable();
        }
    };
    xhr.send('carId=' + vin_number);
}

function reloadCarTable() {
    var xhrReload = new XMLHttpRequest();
    xhrReload.open('GET', 'car_admin_logic.php?action=getAllCars', true);
    xhrReload.onreadystatechange = function () {
        if (xhrReload.readyState === XMLHttpRequest.DONE && xhrReload.status === 200) {
            document.getElementById('carTable').innerHTML = xhrReload.responseText;
        }
    };
    xhrReload.send();
}

function searchByVin() {
    var searchValue = document.getElementById('searchVin').value;
    sendSearchRequest('searchCarsByVin', 'vin', searchValue);
}

function searchByUsername() {
    var searchValue = document.getElementById('searchUsername').value;
    sendSearchRequest('searchCarsByUsername', 'username', searchValue);
}

function sortTable(order) {
    sendSearchRequest('sortCarsByYear', 'order', order);
}

function showAll() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'car_admin_logic.php?action=getAllCars', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('carTable').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function sendSearchRequest(action, paramName, paramValue) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', `car_admin_logic.php?action=${action}&${paramName}=${paramValue}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.getElementById('carTable').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
