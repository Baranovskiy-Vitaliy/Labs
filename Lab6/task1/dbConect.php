<?php

$host = 'localhost';
$dbname = 'lab6';
$dbusername = 'root';
$dbpassword = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);