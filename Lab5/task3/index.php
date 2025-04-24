<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=company_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);

$avgSalary = $pdo->query("SELECT AVG(salary) as avg_salary FROM employees")->fetchColumn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['id'])){
        $test=false;
        foreach($stmt as $row){
            if($row['id'] == $_POST['id']){
                $test=true;
            }
        }
        if($test==false){
            echo "Працівник з таким id не знайдено!";
        }

    if(isset($_POST['delete']) && $test==true){
        $sql = "DELETE FROM employees WHERE id = '". $_POST['id']."'";
        $deleteStmt = $pdo->exec($sql);
        $stmt = $pdo->query("SELECT * FROM employees")->fetchAll(PDO::FETCH_ASSOC);
    
        echo "Працівник успішно звільнений!<br>";
    }

    if(isset($_POST['update']) && $test==true){
        $_SESSION['id'] = $_POST['id'];
        header("Location: update.php?");
    }
}
}

?>

<!DOCTYPE html>
<html>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }

    </style>
<body>    
    <form method="post">
    <table>
        <h2>База працівників</h2>
        <tr>
            <th>Id</th>
            <th>Ім'я</th>
            <th>Посада</th>
            <th>Заробітня плата</th>
        </tr>
        <?php
        foreach($stmt as $row){
                echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['position']."</td><td>".$row['salary']." ₴ </td></tr>";
            
        }
        ?>
        <b>Середня зарплата: </b><?= number_format($avgSalary, 2, '.', ' ') ?> ₴
       <!-- добав тут середню зарплату за допомогою sql запиту -->
    </table>
    </form>


    <form action="insert.php">
        <button type="submit" >Додати новий запис</button>
    </form>
    <form method="post">
        <button type="submit" name="delete">Звільнити працівника за id</button>
        <input type="number" name="id" min="1" required>
    </form>
    <form method="post">
        <button type="submit" name="update">Оновити дані працівника за id</button>
        <input type="number" name="id" min="1" required>
    </form>
    </body>
</html>