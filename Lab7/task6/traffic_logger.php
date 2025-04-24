<?php

include 'bd.php';

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Збір інформації про запит
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $time = date('Y-m-d H:i:s');
    $url = $_SERVER['REQUEST_URI'] ?? 'unknown';
    $http_code = http_response_code(); // Стандартна функція для отримання коду

    // Запис у базу даних
    $stmt = $pdo->prepare("INSERT INTO traffic (ip, time, url, http_code) VALUES (:ip, :time, :url, :http_code)");
    $stmt->execute([
        ':ip' => $ip,
        ':time' => $time,
        ':url' => $url,
        ':http_code' => $http_code
    ]);

?>