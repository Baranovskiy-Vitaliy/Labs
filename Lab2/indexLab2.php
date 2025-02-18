<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сортування міст</title>
</head>
<body>


<h1>Лабораторні роботи з Backend</h1>
    

    <a href="Password.php">Завдання з генерації і перевірки паролю</a><br>
    <!-- <a href="Lab2\indexLab2.php">Лабораторна робота №2</a> -->


<!-- 
<form action="process.php" method="POST">
    <label for="username">Ім'я користувача:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <input type="submit" value="Відправити">
</form> -->



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cities = $_POST['cities']; // Отримуємо введені міста
    $cities_array = explode(" ", $cities); // Розбиваємо рядок на масив
    sort($cities_array); // Сортуємо масив за алфавітом
    $sorted_cities = implode(" ", $cities_array); // Об'єднуємо масив назад у рядок
}
?>



    <h2>Сортування міст за алфавітом</h2>

    <form method="POST">
        <label for="cities">Введіть назви міст (через пробіл):</label><br>
        <input type="text" name="cities" value="<?php echo isset($cities) ? htmlspecialchars($cities) : ''; ?>"><br><br>
        <input type="submit" value="Сортувати"><br><br>

        <?php if (isset($sorted_cities)): ?>
            <label for="sorted_cities">Міста в алфавітному порядку:</label><br>
            <input type="text" value="<?php echo $sorted_cities; ?>" readonly><br><br>
        <?php endif; ?>
    </form>

</body>
</html>