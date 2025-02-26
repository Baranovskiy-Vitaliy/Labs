<?php

$fontSize = isset($_COOKIE['fontSize']) ? $_COOKIE['fontSize'] : '16px';


if (isset($_GET["fontSize"])) {
 $fontSize = $_GET["fontSize"];
 setcookie("fontSize", $fontSize, time() + 60 * 60 * 24 * 30, "/");
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір розміру шрифту</title>
    <style>
        body {
            font-size: <?php echo htmlspecialchars($fontSize); ?>;
        }
        
    </style>
</head>
<body>
        <h1>Завдання 1: Робота з cookie</h1>
        <a href="?fontSize=24px">Великий шрифт</a>
        <a href="?fontSize=16px">Середній шрифт</a>
        <a href="?fontSize=12px">Маленький шрифт</a>
    
    <p>Цей текст змінює розмір шрифту відповідно до вибору користувача.</p><br><br>
    <a href="index3.php">На головну сторінку лабораторної</a>
    
</body>
</html>
