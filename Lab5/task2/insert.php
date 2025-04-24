<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=lab5', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO tov (name, brend, cost, quantity) VALUES ('".$_POST['name']."', '".$_POST['brend']."', '".$_POST['cost']."', '".$_POST['quantity']."')";
            $stmt = $pdo->exec($sql);

            echo "Новий товар успішно додано!<br>";
            }
            catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запис нового товару</title>
</head>
<body>
    <h1>Запис нового товару</h1>
    <form method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Бренд:</td>
                <td><input type="text" name="brend" required></td>
            </tr>
            <tr>
                <td>Ціна:</td>
                <td><input type="number" name="cost" min="1" value='1' required></td>
            </tr>
            <tr>
                <td>Кількість:</td>
                <td><input type="number" name="quantity" min="1" value='1' required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Додати</button></td>
            </tr>
        </table>
    </form>
    <form action="index.php">
        <button type="submit">На головну</button>
    </form>
</body>
</html>