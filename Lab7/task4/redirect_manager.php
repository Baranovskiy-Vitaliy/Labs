<?php
// Починаємо буферизацію
ob_start();

// Шлях до файлу з перенаправленнями
$redirectsFile = 'redirects.json';

// Перевіряємо наявність файлу перенаправлень
if (!file_exists($redirectsFile)) {
    die('Файл перенаправлень не знайдено');
}

// Завантажуємо перенаправлення з JSON-файлу
$redirects = json_decode(file_get_contents($redirectsFile), true);

// Перевіряємо коректність JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Помилка читання файлу перенаправлень: ' . json_last_error_msg());
}

// Отримуємо поточний запит URI без GET-параметрів
$requestUri =  '/' . basename($_SERVER['PHP_SELF']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Перевіряємо, чи існує правило для цього URI
if (isset($redirects[$requestUri])) {
    $target = $redirects[$requestUri];

    // Очищуємо буфер перед відправкою заголовків
    ob_end_clean();

    // Якщо значення - "/404", повертаємо 404 Not Found
    if ($target === "/404") {
        header('HTTP/1.1 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "<p>Сторінку <strong>$uri</strong> було знято з обслуговування.</p>";
        exit;
    } else {
        // Інакше перенаправляємо з 301
        header("Location: $uri", true, 301);
        exit;
    }
}

// Якщо немає перенаправлення — показуємо звичайний контент
http_response_code(200);
echo "<h1>Ласкаво просимо!</h1>";
echo "<p>Ви перебуваєте на сторінці: <strong>$uri</strong></p>";

// Завершуємо буферизацію
ob_end_flush();
?>