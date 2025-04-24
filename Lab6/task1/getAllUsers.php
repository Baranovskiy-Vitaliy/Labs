<?php


try {
    include 'dbConect.php';

    // Запит на отримання всіх користувачів
    $stmt = $pdo->query("SELECT name, email FROM user");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Повертаємо результат у форматі JSON
    echo json_encode($users);

} catch (PDOException $e) {
    // Обробка помилок
    echo json_encode(["message" => "Помилка підключення: " . $e->getMessage()]);
}
