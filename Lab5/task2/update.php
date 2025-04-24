<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=lab5", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}
if(!isset($_SESSION['id'])){
    echo $_SESSION['id'];
    header("Location: index.php");
}
$id = $_SESSION['id'];

    
    $stmt = $pdo->prepare("SELECT * FROM tov WHERE tov_id = ?");
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $record['name'];
        $brend = $record['brend'];
        $cost = $record['cost'];
        $quantity = $record['quantity'];
    


if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
    $name = $_POST['name'];
    $brend = $_POST['brend'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE tov SET name = '".$name."', brend = '".$brend."', cost = '".$cost."', quantity = '".$quantity."' WHERE tov_id = '" . $id."'";
    $stmt = $pdo->exec($sql);
    
    

    echo "Запис оновлено успішно!<br>";
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Оновити запис</h2>
    <form method="post">
        <table>
            <tr>
                <td><label for="id">ID:</label></td>
                <td><label><?php echo $id; ?></label></td>
            </tr>
            <tr>
                <td>Категорія:</td>
                <td><input type="text" name="name" id="name" value="<?php echo $name; ?>" required></td>
            </tr>
            <tr>
                <td>Бренд:</td>
                <td><input type="text" name="brend" id="brend" value="<?php echo $brend; ?>" required></td>
            </tr>
            <tr>
                <td>Ціна(₴):</td>
                <td><input type="number" name="cost" id="cost" value="<?php echo $cost; ?>" min="1" required></td>
            </tr>
            <tr>
                <td>Кількість:</td>
                <td><input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" min="1" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="update">Оновити</button></td>
            </tr>
        </table>
    </form>
    <form action="index.php">
        <button type="submit">На головну</button>
    </form>
</body>
</html>
