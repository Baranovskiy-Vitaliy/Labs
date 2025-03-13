<?php
function deleteFolder($folderPath)
{


    if (!is_dir($folderPath)) {
        echo "Папка не існує.";
        return false;
    }


    $files = array_diff(scandir($folderPath), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;


        if (is_dir($filePath)) {
            deleteFolder($filePath);
        } else {

            unlink($filePath);
        }
    }

    rmdir($folderPath);
    echo "Папка та її вміст успішно видалені.";
    return true;
}

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма коментарів</title>
</head>

<body>

    <h1>Робота з каталогами</h1>
    <a href="delete.php">Перейти на сторінку реєстрації</a><br><br>
    <form method="post">
        <h3>Видалення користувача</h3>
        Login<input type="login" name="login" required><br>
        password<input type="password" name="password" required><br>
        <input type="submit">

    </form>


</body>

</html>




<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    



    $directoryPath = 'users/' . $login;


    if (file_exists($directoryPath)) {
        // Перевіряємо, чи логін та пароль співпадають
        $passwordFile = 'users/' . $login . '/password.txt';
        $found = false;

        if (file_exists($passwordFile)) {

            
            if(file_exists($passwordFile)){
                $file = fopen($passwordFile,"r");
                
                $password = file_get_contents($passwordFile);
                fclose($file);
                
            }
        
            if($_POST['password'] == $password){
                $found = true;

            }
            echo $password;

            
            
        }

        if ($found) {
            // Видаляємо папку та її вміст
            deleteDirectory($directoryPath);
            echo "Папка '$login' успішно видалена.";
        } else {
            echo "Невірний логін або пароль.";
        }
    } else {
        echo "Папка з ім'ям '$login' не існує.";
     }
}


function deleteDirectory($dirPath)
{
    if (!is_dir($dirPath)) {
        return false;
    }

    // Отримуємо список всіх файлів і папок
    $files = array_diff(scandir($dirPath), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $dirPath . DIRECTORY_SEPARATOR . $file;

        if (is_dir($filePath)) {
            deleteDirectory($filePath); // Рекурсивно видаляємо підпапки
        } else {
            unlink($filePath); // Видаляємо файл
        }
    }

    rmdir($dirPath); // Видаляємо саму папку
}
?>