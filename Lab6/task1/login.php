<?php

try{
    include 'dbConect.php';
    
        // Отримуємо дані з JSON, які передаються з JavaScript
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Перевіряємо, чи всі поля заповнені
        if (empty($data['loginEmail']) || empty($data['loginPassword'])) {
            echo json_encode(["message" => "Будь ласка, заповніть всі поля(login.php)"]);
            exit();
        }
    
        // Санітуємо введені дані
        $email = htmlspecialchars($data['loginEmail']);
        $password = htmlspecialchars($data['loginPassword']);
    
        // Підготовка SQL запиту для отримання користувача з бази даних
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Перевіряємо, чи користувач існує
        if ($password == $user['password']) {
            echo json_encode(["message" => "Успішний вхід, " . $user['name']]);
        } else {
            echo json_encode(["message" => "Неправильний email або пароль"]);
        }
    
    } catch (PDOException $e) {
        // Обробка помилок підключення до бази даних
        echo json_encode(["message" => "Помилка підключення: " . $e->getMessage()]);
}
