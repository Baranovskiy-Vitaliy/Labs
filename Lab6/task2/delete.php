<?php

include 'dbConect.php';

$data = json_decode(file_get_contents("php://input"), true);


$idNote = $data['id'];



$sql = "DELETE FROM notes WHERE id = '" . $idNote . "'";
$deleteStmt = $pdo->exec($sql);

if ($deleteStmt) {
    echo json_encode(["message" => "Запис видалено успішно!"]);
} else {
    echo json_encode(["message" => "Помилка при видаленні запису"]);
}
