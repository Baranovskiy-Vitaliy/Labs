<?php
// Шлях до лог-файлу
$logFile = 'requests.log';
// Максимальна кількість запитів
$maxRequests = 5;
// Період обмеження в секундах
$timeWindow = 60;

// Отримуємо IP користувача та поточний час
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

// Зчитуємо всі записи з лог-файлу
$logs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

$newLogs = [];        // Тут зберігатимуться лише свіжі записи
$requestCount = 1;    // Кількість запитів від поточного IP за останню хвилину

foreach ($logs as $log) {
    list($logIp, $logTime) = explode('|', $log);
    $logTime = (int)$logTime;

    // Залишаємо тільки записи за останню хвилину
    if ($logTime >= $time - $timeWindow) {
        $newLogs[] = "$logIp|$logTime";
        if ($logIp === $ip) {
            $requestCount++;
        }
    }
}

if ($requestCount > $maxRequests) {
    // Якщо ліміт перевищено
    http_response_code(429);
    echo "<h1>429 Too Many Requests</h1>";
    echo "<p>Забагато запитів. Спробуйте ще раз пізніше.</p>";
} else {
    // Додаємо новий запис про запит
    $newLogs[] = "$ip|$time";
    // Записуємо оновлений лог-файл без застарілих записів
    file_put_contents($logFile, implode("\n", $newLogs) . "\n");

    // Повертаємо контент
    http_response_code(200);
    echo "<h1>Запит прийнято</h1>";
    echo "<p>Ви зробили $requestCount запит(ів) за останню хвилину.</p>";
}
?>