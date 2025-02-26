<?php
session_start();
function generatePassword($length)
{
    $alfavit = range('a', 'z');
    $alfavitBig = range('A', 'Z');
    $number = range('0', '9');
    // $simvol = range('!', '+');
    $simvol = str_split('!@#$%^&*()-_=+');
    $chars = array_merge($alfavit, $alfavitBig, $number, $simvol);
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[array_rand($chars)];
    }

    return $password;
}
function checkPassword($password)
{
    if (strlen($password) < 8)
        return "Небезпечний (занадто короткий)";
    if (!preg_match("/[a-z]/", $password))
        return "Небезпечний (відсутня мала літера)";
    if (!preg_match("/[A-Z]/", $password))
        return "Небезпечний (відсутня велика літера)";
    if (!preg_match("/[0-9]/", $password))
        return "Небезпечний (відсутня цифра)";
    if (!preg_match("/[\W_]/", $password))
        return "Небезпечний (відсутній спецсимвол)";

    // $arrayPass=str_split($password);
    return "Безпечний";
}
?>


<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 1</title>
</head>

<body>

    <a href="Task2.php"><h1>Завдання 2</h1></a>
    <a href="task3.php"><h1>Завдання 3</h1></a>
    <a href="task4\task4.php"><h1>Завдання 4</h1></a>
    <!-- <a href="Lab2\indexLab2.php">Лабораторна роботяа №2</a> -->

    <h1>Завдання 1</h1>


    <!-- ЗАВДАННЯ 1.1 -->
    <h2>Текст із заміною символів</h2>

    <form method="POST">

        <label>Введіть довільний текст</label>
        <textarea name="text"><?php echo
            isset($_POST['text']) ? $_POST['text'] :
            (isset($_SESSION['text']) ? $_SESSION['text'] : ""); ?></textarea><br>

        <label>Що потрібно замінити</label>
        <input name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] :
            (isset($_SESSION['search']) ? $_SESSION['search'] : ""); ?>"><br>

        <label>На що замінити</label>
        <input name="replace" value="<?php echo isset($_POST['replace']) ? $_POST['replace'] :
            (isset($_SESSION['replace']) ? $_SESSION['replace'] : ""); ?>"><br>

        <input type="hidden" name="formType" value="replace">
        <input type="submit" value="Замінити"><br>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formType']) && $_POST['formType'] == "replace") {
            $_SESSION["text"] = $_POST["text"];
            $_SESSION["search"] = $_POST["search"];
            $_SESSION["replace"] = $_POST["replace"];
            $text = $_POST['text'];
            $search = $_POST['search'];
            $replace = $_POST['replace'];

            $textReplace = str_replace($search, $replace, $text);

            $_SESSION['textReplace'] = $textReplace;
            echo "Результат: " . $_SESSION['textReplace'] . "";
        }
        if (isset($_SESSION['textReplace']) && isset($_POST['formType']) && $_POST['formType'] != "replace") {
            echo "Результат: " . $_SESSION['textReplace'] . "";
        }

        ?>
    </form>



    <!-- ЗАВДАННЯ 1.2 -->
    <br><br>
    <h2>Сортування міст за алфавітом</h2>

    <form method="POST">
        <input type="hidden" name="formType" value="cities">
        <label>Введіть назви міст (через пробіл):</label><br>
        <input type="text" name="cities" value="<?php echo isset($_POST['cities']) ? $_POST['cities'] :
            (isset($_SESSION['cities']) ? $_SESSION['cities'] : ''); ?>"><br><br>
        <input type="submit"><br><br>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formType']) && $_POST['formType'] == "cities") {
            $_SESSION["cities"] = $_POST["cities"];
            $cities = $_POST['cities'];
            $citiesArray = explode(" ", $cities);
            sort($citiesArray);
            $sortCities = implode(" ", $citiesArray);
            $_SESSION["sortCities"] = $sortCities;
            echo "Міста в алфавітному порядку: " . $_SESSION["sortCities"] . "";
        }
        if (isset($_SESSION["sortCities"]) && isset($_POST['formType']) && $_POST['formType'] != "cities")
            echo "Міста в алфавітному порядку: " . $_SESSION["sortCities"] . "";

        ?>
    </form>
    <br><br>

    <!-- ЗАВДАННЯ 1.3 -->
    <h2>Виділення імені файла</h2>

    <form method="post">
        <input type="hidden" name="formType" value="nameFile">
        <label>Введіть повне розташування файлу</label>
        <input type="text" name="fullNameFile" value="<?php echo isset($_POST['fullNameFile']) ? $_POST['fullNameFile'] :
            (isset($_SESSION['fullNameFile']) ? $_SESSION['fullNameFile'] : ""); ?>"><br>
        <input type="submit">
        <br>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["formType"]) && $_POST["formType"] == "nameFile") {
            $_SESSION["fullNameFile"] = $_POST["fullNameFile"];

            $_SESSION["nameFile"] = pathinfo($_SESSION["fullNameFile"], PATHINFO_FILENAME);
            echo "Імя файлу: " . $_SESSION["nameFile"] . "";
        }
        if (isset($_SESSION["nameFile"]) && isset($_POST["formType"]) && $_POST["formType"] != "nameFile")
            echo "Імя файлу: " . $_SESSION["nameFile"] . "";

        ?>
    </form>


    <br><br>

    <!-- ЗАВДАННЯ 1.4 -->
    <h2>Робота із датами</h2>

    <form method="post">
        <input type="hidden" name="formType" value="date">
        <label>Введіть дати</label><br>
        <input type="date" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] :
            (isset($_SESSION['date1']) ? $_SESSION['date1'] : ""); ?>">
        <input type="date" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] :
            (isset($_SESSION['date2']) ? $_SESSION['date2'] : ""); ?>">
        <br>
        <input type="submit">
        <br>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["formType"]) && $_POST["formType"] == "date") {
            $_SESSION['date1'] = $_POST["date1"];
            $_SESSION["date2"] = $_POST["date2"];

            $date1 = DateTime::createFromFormat('Y-m-d', $_POST['date1'])->format('d-m-Y');
            $date2 = DateTime::createFromFormat('Y-m-d', $_POST['date2'])->format('d-m-Y');

            $date1Obj = DateTime::createFromFormat('d-m-Y', $date1);
            $date2Obj = DateTime::createFromFormat('d-m-Y', $date2);

            $_SESSION['interval'] = $date1Obj->diff($date2Obj);

            echo "Кількість днів між датами : " . $_SESSION['interval']->days;
        }

        if (isset($_SESSION['interval']) && isset($_POST["formType"]) && $_POST["formType"] != "date")
            echo "Кількість днів між датами : " . $_SESSION['interval']->days;

        ?>
    </form>

    <br><br>

<!-- ЗАВДАННЯ 1.5 -->
<h2>Генерація паролю</h2>
    <form method="POST"> 
        <label>Із скількох елементів має складатися пароль</label>
        <input type="number" name="passwordLength" min="5" max="20" 
            value="<?php echo isset($_POST['passwordLength']) ? $_POST['passwordLength'] : 
            (isset($_SESSION['passwordLength']) ? $_SESSION['passwordLength'] : ''); ?>"> 
        <input type="hidden" name="formType" value="generate"><br>
        <input type="submit" value="Згенерувати пароль">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formType']) && $_POST['formType'] == "generate") {
        if (isset($_POST["passwordLength"])) {
            $passwordLength = $_POST['passwordLength'];
            $_SESSION['passwordLength'] = $passwordLength;
            $_SESSION['generatePassword'] = generatePassword(($passwordLength));
            
            echo "Згенерований пароль: " . $_SESSION['generatePassword'];
        }
    }
    if(isset($_SESSION['generatePassword']) && isset($_POST['formType']) && $_POST['formType'] != "generate"){
        echo "Згенерований пароль: " . $_SESSION['generatePassword'];
    }
    ?>
 <br><br>

<!-- ЗАВДАННЯ 1.6 -->
<h2>Перевірка паролю</h2>
    <form method="POST">
        <label>Введіть пароль для перевірки</label>
        <input type="text" name="password" maxlength="25"
            value="<?php echo isset($_POST['password']) ? $_POST['password'] :
             (isset($_SESSION['password']) ? $_SESSION['password'] : ''); ?>">
        <input type="hidden" name="formType" value="check"><br>
        <input type="submit" value="Перевірити пароль">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formType']) && $_POST['formType'] == "check") {
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            $_SESSION['password'] = $password;
            $_SESSION['checkPassword'] = checkPassword($password);
            echo "Даний пароль є: " . $_SESSION['checkPassword'];
        }
    }
    if(isset($_SESSION['checkPassword']) && isset($_POST['formType']) && $_POST['formType'] != "check") 
        echo "Даний пароль є: " . $_SESSION['checkPassword'];
    ?>




</body>

</html>