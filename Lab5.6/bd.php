<?php
// backend/db.php
$host = 'localhost';
$dbname = 'user_management';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}
?>