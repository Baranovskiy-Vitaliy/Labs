<?php
session_start();

if (isset($_COOKIE["lang"]))
    $lang = $_COOKIE["lang"];
else
    $lang = 'ukr';


if (isset($_GET["lang"])) {
    $lang = $_GET["lang"];
    setcookie("lang", $lang, time() + 60 * 60 * 24 * 180, "/");
}


?>


<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завдання 3</title>
    <style>
        .langIcon {
            position: absolute;
            top: 5%;
            right: 5%;
        }

        .langIcon img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>

    <div class="langIcon">
        <a href="task3.php?lang=ukr">
            <img src="ukr.png" alt="Українська" title="Українська" />
        </a>
        <a href="task3.php?lang=eng">
            <img src="eng.png" alt="English" title="English" />
        </a>
        <p>Вибрана мова: 
        <?php
        if ($lang == 'ukr') {
            echo 'Українська';
        } elseif ($lang == 'eng') {
            echo 'English';
        }
        ?>
    </div>

    <form action="task3.1.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Логін:</td>
                <td><input type="text" name="login" required
                        value="<?php echo isset($_SESSION["login"]) ? $_SESSION["login"] : "" ?>">
                </td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="password" required
                        value="<?php echo isset($_SESSION["password"]) ? $_SESSION["password"] : "" ?>"></td>
            </tr>
            <tr>
                <td>Пароль (ще раз):</td>
                <td><input type="password" name="passwordCheck" required
                        value="<?php echo isset($_SESSION["passwordCheck"]) ? $_SESSION["passwordCheck"] : "" ?>">
                </td>
            </tr>
            <tr>
                <td>Стать:</td>
                <td>
                    <input type="radio" name="gender" value="чоловік" required <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'чоловік')
                        echo 'checked'; ?>>чоловік
                    <input type="radio" name="gender" value="жінка" required <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'жінка')
                        echo 'checked'; ?>>жінка
                </td>
            </tr>
            <tr>
                <td>Місто:</td>
                <td>
                    <select name="city">
                        <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Житомир")
                            echo "selected" ?>>
                                Житомир</option>
                            <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Київ")
                            echo "selected" ?>>Київ
                            </option>
                            <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Львів")
                            echo "selected" ?>>
                                Львів</option>
                            <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Одеса")
                            echo "selected" ?>>
                                Одеса</option>
                            <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Харків")
                            echo "selected" ?>>
                                Харків</option>
                            <option <?php if (isset($_SESSION["city"]) && $_SESSION["city"] == "Дніпро")
                            echo "selected" ?>>
                                Дніпро</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Улюблені ігри:</td>
                    <td>
                        <input type="checkbox" name="games[]" value="футбол" <?php echo (in_array("футбол", $_SESSION["games"] ?? [])) ? 'checked' : ''; ?>>футбол<br>
                    <input type="checkbox" name="games[]" value="баскетбол" <?php echo (in_array("баскетбол", $_SESSION["games"] ?? [])) ? 'checked' : ''; ?>>баскетбол<br>
                    <input type="checkbox" name="games[]" value="волейбол" <?php echo (in_array("волейбол", $_SESSION["games"] ?? [])) ? 'checked' : ''; ?>>волейбол<br>
                    <input type="checkbox" name="games[]" value="шахи" <?php echo (in_array("шахи", $_SESSION["games"] ?? [])) ? 'checked' : ''; ?>>шахи<br>
                    <input type="checkbox" name="games[]" value="Word of Tanks" <?php echo (in_array("Word of Tanks", $_SESSION["games"] ?? [])) ? 'checked' : ''; ?>>Word of Tanks
                </td>
            </tr>
            <tr>
                <td>Про себе:</td>
                <td><textarea name="about"
                        required><?php echo isset($_SESSION["about"]) ? $_SESSION["about"] : "" ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Фотографія:</td>
                <td><input type="file" name="photo" accept="image/*"></td>

            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Зареєструватися"></td>
            </tr>
        </table>
    </form>

</body>

</html>