<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab5;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $passwordCheck = $_POST['passwordCheck'];
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        if (isset($_POST['sex']))
            $sex = $_POST['sex'];
        else
            $sex = null;
        $city = $_POST['city'];
        $birthday = $_POST['birthday'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if ($password !== $passwordCheck) {
            echo "Паролі не співпадають";

        } else {
            $checkLoginSql = "SELECT COUNT(*) FROM user WHERE login = :login";
            $stmt = $pdo->prepare($checkLoginSql);
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $loginCount = $stmt->fetchColumn();

            $checkEmailSql = "SELECT COUNT(*) FROM user WHERE email = :email";
            $stmt = $pdo->prepare($checkEmailSql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $emailCount = $stmt->fetchColumn();

            if ($loginCount > 0) {
                echo "Цей логін вже зайнятий!";
                
            } else if ($emailCount > 0) {
                echo "Ця пошта вже зайнята!";
                
            }else if (strtotime($birthday) > time()) {
                echo "Дата народження не може бути в майбутньому!";
            } else {
                $sql = "INSERT INTO user (login, password, name, last_name, sex, city, birthday, phone, email) 
                    VALUES (:login, :password, :name, :last_name, :sex, :city, :birthday, :phone, :email)";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':sex', $sex);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':birthday', $birthday);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);

                if ($stmt->execute()) {
                    // echo "<script>alert('Користувача успішно зареєстровано!')</script>"; 
                    // header('Location: task1.php'); 

                    echo "<script>alert('Користувача успішно зареєстровано!'); window.location.href = 'task1v3.php';</script>";

                } else {
                    echo "Сталася помилка при реєстрації.";
                }
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    </style>
</head>

<body>
    <h1>Реєстрація нового користувача</h1>
    <form method="post">
        <table>
            <tr>
                <td>Логін:</td>
                <td><input type="text" name="login" required value="<?php echo $_POST['login'] ?? "" ?>"></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="password" required value="<?php echo $_POST['password'] ?? ""?>"></td>
            </tr>
            <tr>
                <td>Пароль (ще раз):</td>
                <td><input type="password" name="passwordCheck" required value="<?php echo $_POST['passwordCheck'] ?? ""?>"></td>
            </tr>
            <tr>
                <td>Ім'я</td>
                <td><input type="text" name="name" required value="<?php echo $_POST['name'] ?? ""?>"></td>
            </tr>
            <tr>
                <td>Прізвище</td>
                <td><input type="text" name="last_name" required value="<?php echo $_POST['last_name'] ?? ""?>"></td>
            </tr>
            <tr>
                <td>Стать:</td>
                <td>
                    <input type="radio" name="sex" value="<?php echo $_POST['sex'] ?? ""?>">чоловік
                    <input type="radio" name="sex" value="<?php echo $_POST['sex'] ?? ""?>">жінка
                </td>
            </tr>
            <tr>
                <td>Місто:</td>
                <td><input type="text" name="city" required value="<?php echo $_POST['city'] ?? ""?>"></td>
            </tr>

            <tr>
                <td>День народження:</td>
                <td><input type="date" name="birthday" required value="<?php echo $_POST['birthday'] ?? ""?>"></td>
            </tr>
            <tr>
                <td>Телефон:</td>
                <td><input type="tel" name="phone" pattern="(\+?\d{1,3}[- ]?)?\(?\d{1,4}\)?[- ]?\d{1,4}[- ]?\d{1,4}" required value="<?php echo $_POST['phone'] ?? ""?>"></td>                                                          <!-- pattern="(\+?\d{1,3}[- ]?)?\(?\d{1,4}\)?[- ]?\d{1,4}[- ]?\d{1,4}" -->
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" required value="<?php echo $_POST['email'] ?? ""?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Зареєструватися"></td>
            </tr>
        </table>
    </form>
    <form action="task1v3.php">
        <input type="submit" value="Повернутись до входу">
    </form>


</body>

</html>