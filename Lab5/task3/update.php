<?php
session_start();
try {
    $pdo = new PDO("mysql:host=localhost;dbname=company_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}
if(!isset($_SESSION['id'])){
    echo $_SESSION['id'];
    header("Location: index.php");
}
$id = $_SESSION['id'];

    
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $record['name'];
        $position = $record['position'];
        $salary = $record['salary'];
    


if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
    $name = htmlspecialchars($_POST['name']);
    $position = htmlspecialchars($_POST['position']);
    $salary = htmlspecialchars($_POST['salary']);

    $sql = "UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $position, $salary, $id]);
    
    

    echo "Запис успішно оновлено!<br>";
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Оновити дані працівника</h2>
    <form method="post">
        <table>
            <tr>
                <td>ID:</td>
                <td><label><?php echo $id; ?></label></td>
            </tr>
            <tr>
                <td>Категорія:</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>" required></td>
            </tr>
            <tr>
                <td>Бренд:</td>
                <td><input type="text" name="position" value="<?php echo $position; ?>" required></td>
            </tr>
            <tr>
                <td>Заробітня плата(₴):</td>
                <td><input type="number" name="salary" value="<?php echo $salary; ?>" min="8000" required></td>
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
