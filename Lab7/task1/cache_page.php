<?php
// Назва файлу кешу
$cacheFile = 'cache.html';

// Якщо кеш існує — віддаємо його
if (file_exists($cacheFile)) {
    // Встановлюємо заголовок 200 OK
    header("HTTP/1.1 200 OK");
    // Виводимо кешований вміст
    readfile($cacheFile);
    exit;
}

// Починаємо буферизацію виводу
ob_start();

// ----------- Початок генерації сторінки -----------
// Тут ви можете згенерувати будь-який HTML-код сторінки


// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Отримуємо дані з POST-запиту
//     http_response_code(404);
// }

if(empty($_GET)){
$_GET['stat'] = '200';
}


if($_GET['stat'] === '200') {   
    // Отримуємо дані з GET-запиту
    http_response_code(200);
    
    echo "<h1>Сторінка успішно завантажена</h1>";
    echo "<p>Це згенерований вміст сторінки.</p>";

} else {
    // Отримуємо дані з GET-запиту
    http_response_code(404);
    echo "<h1>Помилка 404</h1>";
}



// ----------- Кінець генерації сторінки -----------

// Отримуємо статус відповіді
$statusCode = http_response_code();

// Отримуємо вміст буфера
$content = ob_get_contents();

// Завершуємо буферизацію (вивід буде здійснено автоматично)
ob_end_flush();

// Кешування відповідно до статусу
if ($statusCode === 200) {
    // Зберігаємо сторінку у файл
    file_put_contents($cacheFile, $content);
} elseif ($statusCode === 404) {
    // Видаляємо кеш, якщо існує
    if (file_exists($cacheFile)) {
        unlink($cacheFile);
    }
}
?>