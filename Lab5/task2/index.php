<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=lab5", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM tov")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['id'])){
        $test=false;
        foreach($stmt as $row){
            if($row['tov_id'] == $_POST['id']){
                $test=true;
            }
        }
        if($test==false){
            echo "Товар з таким id не знайдено!";
        }

    if(isset($_POST['delete']) && $test==true){
        include 'delete.php';
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
        <h2>Магазин електроніки</h2>
        <tr>
            <th>Id</th>
            <th>Категорія</th>
            <th>Бренд</th>
            <th>Ціна(₴)</th>
            <th>Кількість</th>
        </tr>
        <?php
        foreach($stmt as $row){
                echo "<tr><td>".$row['tov_id']."</td><td>".$row['name']."</td><td>".$row['brend']."</td><td>".$row['cost']."</td><td>".$row['quantity']."</td></tr>";
            
        }
        ?>
       
    </table>
    </form>


    <form action="insert.php">
        <button type="submit" >Додати новий запис</button>
    </form>
    <form method="post">
        <button type="submit" name="delete">Видалити запим за id</button>
        <input type="number" name="id" min="1" required>
    </form>
    <form method="post">
        <button type="submit" name="update">Оновити запис за id</button>
        <input type="number" name="id" min="1" required>
    </form>
    </body>
</html>