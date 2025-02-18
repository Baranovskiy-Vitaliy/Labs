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
    if (!preg_match("/[!@#$%^&*()-_=+]/", $password))
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
    <title></title>
</head>

<body>

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
    if(isset($_SESSION['generatePassword']) && isset($_POST['formType']) && $_POST['formType'] == "check"){
        echo "Згенерований пароль: " . $_SESSION['generatePassword'];
    }
    ?>

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
    if(isset($_SESSION['checkPassword']) && isset($_POST['formType']) && $_POST['formType'] == "generate") 
        echo "Даний пароль є: " . $_SESSION['checkPassword'];
    ?>

</body>

</html>
