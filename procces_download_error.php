<?php
require_once 'database_config.php';
require_once 'vendor/autoload.php'; // Путь к библиотеке PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

$sql = "SELECT error_code, error_name, error_description FROM car_errors";
$result = $conn->query($sql);
if (!$result) {
    echo "Ошибка при выполнении запроса: " . $conn->error;
    exit;
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Код ошибки');
$sheet->setCellValue('B1', 'Название ошибки');
$sheet->setCellValue('C1', 'Описание ошибки');

$row = 2; // Начальная строка для данных
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['error_code']);
    $sheet->setCellValue('B' . $row, $row_data['error_name']);
    $sheet->setCellValue('C' . $row, $row_data['error_description']);
    $row++;
}

$conn->close();

$writer = new Xlsx($spreadsheet);
$writer->save('таблица_ошибок.xlsx');

echo "Таблица ошибок успешно экспортирована в файл Excel.";
?>