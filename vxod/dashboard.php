<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Подключение к базе данных
$host = 'localhost';
$db = 'my_app';
$user = 'root'; // Ваше имя пользователя MySQL
$pass = ''; // Ваш пароль MySQL

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение списка PDF-файлов
$pdfs = [];
$result = $conn->query("SELECT * FROM pdf_files");

while ($row = $result->fetch_assoc()) {
    $pdfs[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
</head>
<body>
    <h2>Добро пожаловать!</h2>
    <h3>Список PDF-файлов:</h3>
    <ul>
        <?php foreach ($pdfs as $pdf): ?>
            <li><a href="path/to/pdf/<?php echo $pdf['filename']; ?>"><?php echo $pdf['filename']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    
    <a href="logout.php">Выйти</a>
</body>
</html>
