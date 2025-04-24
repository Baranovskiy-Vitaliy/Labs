<?php

$host = 'localhost';
$dbname = 'lab7';
$dbusername = 'root';
$dbpassword = '';

try {
    

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
} catch (PDOException $e) {
    die("Помилка підключення: " . $e->getMessage());
}
?>