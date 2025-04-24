<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=company_db', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $name = htmlspecialchars($_POST['name']);
            $position = htmlspecialchars($_POST['position']);
            $salary = htmlspecialchars($_POST['salary']);
            

            $sql = "INSERT INTO employees (name, position, salary) VALUES ( ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $position, $salary]);
                      
            


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
    </head>
<body>
    <h1>Запис нового працівника</h1>
    <form method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Посада:</td>
                <td><input type="text" name="position" required></td>
            </tr>
            <tr>
                <td>Заробітня плата:</td>
                <td><input type="number" name="salary" min="8000" value='8000' required></td>
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