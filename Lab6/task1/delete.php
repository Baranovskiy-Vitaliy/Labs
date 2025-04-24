<?php

include 'dbConect.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['loginEmail'];



$sql = "DELETE FROM user WHERE email = '" . $email . "'";
$deleteStmt = $pdo->exec($sql);

if ($deleteStmt) {
    echo json_encode(["message" => "Користувача видалено успішно!"]);
} else {
    echo json_encode(["message" => "Помилка при видаленні користувача"]);
}
