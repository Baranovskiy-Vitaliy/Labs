<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма коментарів</title>
</head>
<body>

<h1>Робота з каталогами</h1>
<a href="delete.php">Перейти на сторінку з видаленням даних</a><br><br>
<form method="post">
    <h3>Реєстація нового рористувача</h3>
    Login<input type="login" name="login" required><br>
    password<input type="password" name="password" required><br>
    <input type="submit">

</form>


</body>
</html>


<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['login'];
    $password = $_POST['password'];

    $directoryPath = 'users/' . $login;


    if (file_exists($directoryPath)) {
        echo "Login: '$login' вже існує.";
    } else {
        //echo "sdfhsjfhjsdjfk";
        mkdir($directoryPath, 0755, true); // як буде називатись дана директорія

        mkdir($directoryPath . '/video', 0755, true);
        mkdir($directoryPath . '/music', 0755, true);
        mkdir($directoryPath . '/photo', 0755, true);

        file_put_contents($directoryPath . '/video/video1.txt', 'Це файл відео.');
        file_put_contents($directoryPath . '/music/music1.txt', 'Це файл музики.');
        file_put_contents($directoryPath . '/photo/photo1.txt', 'Це файл фотографії.');

        // touch($directoryPath . '/video/video1.mp4');
        // touch($directoryPath . '/music/music1.mp3');
        // touch($directoryPath . '/photo/photo1.jpg');

        file_put_contents($directoryPath . '/password.txt', $password);

}
}