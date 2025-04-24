<?php
// indexphp.php

try {
    // Підключення до бази даних через PDO
    include 'dbConect.php';

    // Отримуємо дані з JSON, які передаються з JavaScript
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Перевіряємо, чи всі поля заповнені
    if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
        echo json_encode(["message" => "Будь ласка, заповніть всі поля(indexphp.php)"]);
        exit();
    }

    // Санітуємо введені дані
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);

    // Хешуємо пароль перед збереженням
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Перевіряємо, чи вже існує користувач з таким email
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $userCount = $stmt->fetchColumn();
    if ($userCount > 0) {
        echo json_encode(["message" => "Ця електронна адреса вже використовується"]);
        exit();
    }
    // Перевіряємо, чи вже існує користувач з таким ім'ям
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE name = ?");
    $stmt->execute([$name]);
    $userCount = $stmt->fetchColumn();
    if ($userCount > 0) {
        echo json_encode(["message" => "Це ім'я вже використовується"]);
        exit();
    }


    // Підготовка SQL запиту для вставки користувача у базу даних
    $sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $password]);

    // Повертаємо JSON відповідь про успішну реєстрацію
    echo json_encode(["message" => "Реєстрація успішна!"]);

} catch (PDOException $e) {
    // Обробка помилок підключення до бази даних
    echo json_encode(["message" => "Помилка підключення: " . $e->getMessage()]);
}