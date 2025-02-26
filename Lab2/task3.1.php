<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["passwordCheck"] = $_POST["passwordCheck"];
        $_SESSION["gender"] = $_POST["gender"];
        $_SESSION["city"] = $_POST["city"];
        $_SESSION["games"] = $_POST["games"];
        $_SESSION["about"] = $_POST["about"]; 


    $passwordRes = "";
    if($_POST['password'] == $_POST['passwordCheck']) 
        $passwordRes .= "Співпадають";
    else
    $passwordRes .= "Не співпадають";

    $games = implode("<br>", $_POST["games"]);
    
    $photoPath = "";
    $uploadDir = "uploads/";
    $photoPath = $uploadDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
} else {
    echo "Дані не були передані.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Результати реєстрації</title>
    <style>
    td:first-child{
        vertical-align: top;
        text-align: right;
        color: gray;
    }

</style>
</head>
<body>

<table>
    <tr>
        <td>Логін: </td>
        <td><?php echo $_POST['login'] ?></td>
    </tr>
    <tr>
        <td>Пароль: </td>
        <td><?php echo $passwordRes; ?> </td>
    </tr>
    <tr>
        <td>Стать: </td>
        <td><?php echo $_POST['gender']; ?></td>
    </tr>
    <tr>
        <td>Місто: </td>
        <td><?php echo $_POST['city']; ?></td>
    </tr>
    <tr>
        <td>Улюблені ігри: </td>
        <td><?php echo $games; ?></td>
    </tr>
    <tr>
        <td>Про себе: </td>
        <td><?php echo nl2br($_POST['about']); ?></td>
    </tr>
    <? if($photoPath): ?>
    <tr>
        <td>Фотографія: </td>
        <td><img src="<?php echo $photoPath; ?>" alt="Фото користувача" width="200"></td>
    </tr>
    <? endif; ?>
</table>

<a href="task3.php">Повернутися на головну сторінку</a>


</body>
</html>