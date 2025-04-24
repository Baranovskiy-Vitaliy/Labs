<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=lab5", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}


if (isset($_POST['login'])) {
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    
    $stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
    $stmt->execute([':login' => $login, ':password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    


    if (isset($user['password']) && $password == $user['password']) {
        $_SESSION['user_id'] = $user["user_id"];
        $_SESSION['name'] = $user['name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['birthday'] = $user['birthday'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['city'] = $user['city'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['sex'] = $user['sex'];
        $_SESSION['login'] = $user['login'];
    } else {
        echo "Неправильний логін або пароль.";
    }
}



if (isset($_POST['update'])) {
    $newName = htmlspecialchars($_POST['name']);
    $newPassword = htmlspecialchars($_POST['password']);
    $newLastName = htmlspecialchars($_POST['last_name']);
    $newBirthday = htmlspecialchars($_POST['birthday']);
    $newPhone = htmlspecialchars($_POST['phone']);
    $newCity = htmlspecialchars($_POST['city']);
    $newEmail = htmlspecialchars($_POST['email']);
    $newSex = htmlspecialchars($_POST['sex']);
    $newLogin = htmlspecialchars($_POST['login']);
    

    
    $stmt = $pdo->prepare("UPDATE user SET name = ?, last_name = ?, birthday = ?, password = ?, phone = ?, sex = ?, email = ?, city = ?, login = ?  WHERE user_id = ?");
    $stmt->execute([$newName, $newLastName, $newBirthday, $newPassword, $newPhone, $newSex, $newEmail, $newCity, $newLogin, $_SESSION['user_id']]);

    $stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
    $stmt->execute([':login' => $login, ':password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user_id'] = $user["user_id"];
    $_SESSION['name'] = $user['name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['birthday'] = $user['birthday'];
    $_SESSION['password'] = $user['password'];
    $_SESSION['phone'] = $user['phone'];
    $_SESSION['city'] = $user['city'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['sex'] = $user['sex'];
    $_SESSION['login'] = $user['login'];
    //header('Location: task1v3.php');
    echo "Дані оновлено.";
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: task1v3.php');
}

if (isset($_POST['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    session_destroy();
    
    header('Location: task1v3.php');
    echo "Обліковий запис Видалений";
}
?>

<!DOCTYPE html>
<html>
<body>
<?php if (!isset($_SESSION['login'])): ?>
    
    <form method="post">
    <table>
        <h3>Вхід в обліковий запис</h3>
        <tr>
            <td>Логін:</td>
            <td><input type="text" name="login" required></td>
        </tr>
        <tr>
            <td>Пароль:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td><input type="submit" ></td>  
        </tr>
    </table>
    </form>
    <form action="registration.php">
        <button type="submit" >Зареєструватись</button>
    </form>
<?php else: ?>
    <h2>Доброго дня, <?php echo $_SESSION['login']; ?>!</h2>
    <form method="post">
        
        <table>
            <tr>
                <td>Логін:</td>
                <td><input type="text" name="login" required value="<?php echo $_SESSION['login'] ?>"></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="password" required value="<?php echo $_SESSION['password'] ?>"></td>
            </tr>
            <tr>
                <td>Ім'я</td>
                <td><input type="text" name="name" required value="<?php echo $_SESSION['name'] ?>"></td>
            </tr>
            <tr>
                <td>Прізвище</td>
                <td><input type="text" name="last_name" required value="<?php echo $_SESSION['last_name'] ?>"></td>
            </tr>
            <tr>
                <td>Стать:</td>
                <td>
                    <input type="radio" name="sex" value="1" <?php if($_SESSION['sex'] == 1):?> checked <?php endif; ?> >чоловік
                    <input type="radio" name="sex" value="0" <?php if($_SESSION['sex'] == 0):?> checked <?php endif; ?>>жінка
                </td>
            </tr>
            <tr>
                <td>Місто:</td>
                <td><input type="text" name="city" required value="<?php echo $_SESSION['city'] ?>"></td>
            </tr>

            <tr>
                <td>День народження:</td>
                <td><input type="date" name="birthday" required value="<?php echo $_SESSION['birthday'] ?>"></td>
            </tr>
            <tr>
                <td>Телефон:</td>
                <td><input type="tel" name="phone" required value="<?php echo $_SESSION['phone'] ?>"></td>                                                          <!-- pattern="(\+?\d{1,3}[- ]?)?\(?\d{1,4}\)?[- ]?\d{1,4}[- ]?\d{1,4}" -->
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" required value="<?php echo $_SESSION['email'] ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Оновити дані"></td>
            </tr>
        </table>


    </form>
    <form method="post"><button type="submit" name="logout">Вийти з облікового запису</button></form>
    <form method="post"><button type="submit" name="delete">Видалити обліковий запис</button></form>
    <?php endif; ?>
</body>
</html



