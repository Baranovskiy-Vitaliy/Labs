<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завантаження файлів</title>
</head>
<body>

    <h2>Завантажити зображення</h2>
    <form method="post" enctype="multipart/form-data" action="">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Завантажити</button>
    </form>


    
<?php
$catalog = 'photographs/';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);

    
        $filePath = $catalog . $fileName;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            echo "Файл успішно завантажено";
        } 
    } 
}

    $files = array_diff(scandir($catalog), ['.', '..']);

    if (count($files) > 0) {
        echo "<h2>Список файлів у каталозі:</h2>";
        foreach ($files as $file) {
            echo "<li><a href='$catalog$file' target='_blank'>$file</a></li>";
        }
    } else {
        echo "<p>Каталог порожній.</p>";
    }
?>

</body>
</html>