<?php
session_start();
echo '<h1>Завдання 2: Робота з session</h1>';

$users = [
    "admin" => "admin",
    "vitaliy" => "1111",
];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["login"] = $_POST["login"];
    $_SESSION["password"] = $_POST["password"];
    
}
if(isset($_SESSION['login'])){
    if (isset($users[$_SESSION["login"]]) && $users[$_SESSION["login"]] == $_SESSION["password"]) {
        $_SESSION["logout"] = 0;
        echo "<h1>Добрий день," . $_SESSION["login"] . "!</h1><br>";
        echo '<a href="?logout=1">Вийти</a>';
    } else {
        echo "Невірний логін чи пароль";
    }
    }

    if(!isset($_SESSION["logout"])){
        echo '
        <form method="post">
            Логін: <input type="text" name="login" required><br>
            Пароль: <input type="password" name="password" required><br>
            <input type="submit" value="Вхід"><br>
        </form>';
    }
  

if (isset($_GET['logout'])){
    session_destroy();
    header("Location: task2.php");
}
    