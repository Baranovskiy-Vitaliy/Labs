<?php
$sql = "DELETE FROM tov WHERE tov_id = '" . $_POST['id'] . "'";
$deleteStmt = $pdo->exec($sql);
$stmt = $pdo->query("SELECT * FROM tov")->fetchAll(PDO::FETCH_ASSOC);

echo "Товар успішно видалено!<br>";
