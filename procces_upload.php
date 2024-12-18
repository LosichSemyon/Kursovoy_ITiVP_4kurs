<?php
require_once 'database_config.php';
require_once 'vendor/autoload.php'; // Путь к библиотеке PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];

    $spreadsheet = IOFactory::load($fileTmpPath);
    $worksheet = $spreadsheet->getActiveSheet();

    if ($worksheet->getHighestRow() > 1) {
        $sql = "TRUNCATE TABLE car_errors";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Ошибка при очистке таблицы ошибок: " . $conn->error;
            exit;
        }

        foreach ($worksheet->getRowIterator(2) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $error_code = $cellIterator->current()->getValue();
            $cellIterator->next();
            $error_name = $cellIterator->current()->getValue();
            $cellIterator->next();
            $error_description = $cellIterator->current()->getValue();

            $sql = "INSERT INTO car_errors (error_code, error_name, error_description) VALUES ('$error_code', '$error_name', '$error_description')";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Ошибка при записи в базу данных: " . $conn->error;
                exit;
            }
        }

        echo "Ошибки успешно загружены в базу данных.";
    } else {
        echo "Файл не содержит данных.";
    }
} else {
    echo "Ошибка при загрузке файла.";
}

$conn->close();
?>