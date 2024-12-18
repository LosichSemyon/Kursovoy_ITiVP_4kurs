<!DOCTYPE html>
<html>
<head>
    <title>Загрузка и выгрузка ошибок</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-top: 100px;
        }

        p {
            font-size: 14px;
        }
        button {
            background-color: yellow;
            color: #000;
            border: 2px solid #000;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ccc;
        }

    </style>
</head>
<body>
    <h1>Загрузка и выгрузка ошибок</h1>
    <form action="procces_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel_file" accept=".xlsx, .xls">
        <button type="submit">Загрузить</button>
    </form>

    <form action="procces_download_error.php" method="POST">
        <button type="submit">Выгрузить ошибки</button>
    </form>
</body>
</html>