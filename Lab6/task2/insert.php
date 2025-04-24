<?php
// indexphp.php

try {
    // Підключення до бази даних через PDO
    include 'dbConect.php';

    // Отримуємо дані з JSON, які передаються з JavaScript
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Перевіряємо, чи всі поля заповнені
    if (empty($data['title']) || empty($data['note'])) {
        echo json_encode(["message" => "Будь ласка, заповніть всі поля(indexphp.php)"]);
        exit();
    }

    // Санітуємо введені дані
    $title = htmlspecialchars($data['title']);
    $note = htmlspecialchars($data['note']);



    echo $title . " " . $note;
    // Підготовка SQL запиту для вставки користувача у базу даних
    $sql = "INSERT INTO notes (title, note) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $note]);

    // Повертаємо JSON відповідь про успішну реєстрацію
    echo json_encode(["message" => "Запис створено!"]);

} catch (PDOException $e) {
    // Обробка помилок підключення до бази даних
    echo json_encode(["message" => "Помилка підключення: " . $e->getMessage()]);
}