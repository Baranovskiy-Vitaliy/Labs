<?php


try {
    include 'dbConect.php';

    // Запит на отримання всіх користувачів
    $stmt = $pdo->query("SELECT id, title, note FROM notes");
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Повертаємо результат у форматі JSON
    echo json_encode($notes);

} catch (PDOException $e) {
    // Обробка помилок
    echo json_encode(["message" => "Помилка підключення: " . $e->getMessage()]);
}
