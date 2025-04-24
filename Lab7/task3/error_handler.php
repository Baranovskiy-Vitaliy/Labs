<?php
// Увімкнення буферизації
ob_start();

// Реєструємо обробник фатальних помилок
register_shutdown_function('handleFatalError');

// Обробник warning/notice
set_error_handler('customErrorHandler');

// Перевіряємо, чи потрібно згенерувати якусь помилку
if (isset($_GET['error'])) {
    $errorType = $_GET['error'];

    switch ($errorType) {
        case 'fatal':
            // Викликаємо неіснуючу функцію (фатальна помилка)
            callToUndefinedFunction();
            break;
        case 'division_by_zero':
            // Warning: ділення на нуль
            echo 10 / 0;
            break;
        case 'type_error':
            // TypeError: передача рядка замість int
            function testInt(int $x) { return $x * 2; }
            echo testInt("hello");
            break;
    }
}

// Виводимо HTML-контент
http_response_code(200);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Тестування помилок у PHP</title>
</head>
<body>
    <h1>Сторінка працює</h1>
    <p>Усе відбулось без критичних помилок.</p>

    <h2>Тестування помилок</h2>
    <form method="get">
        <button type="submit" name="error" value="fatal">Фатальна помилка</button>
        <button type="submit" name="error" value="division_by_zero">Ділення на 0</button>
        <button type="submit" name="error" value="type_error">Використання неправильного типу змінної</button>
    </form>
</body>
</html>

<?php
// Функція для обробки фатальних помилок
function handleFatalError() {
    $error = error_get_last();

    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        ob_clean(); // Очищаємо буфер
        http_response_code(500);
        echo "<h1>500 Внутрішня помилка сервера</h1>";
        echo "<p>Сталася критична помилка: <strong>{$error['message']}</strong></p>";
        echo "<p>У файлі: {$error['file']} (рядок {$error['line']})</p>";
        echo "<p>Очікуваний час вирішення: " . date('H:i', time() + 14400) . "</p>";
    } else {
        ob_end_flush(); // Виводимо накопичене
    }
}

// Обробка warning/notice — для зручного виводу
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "<div style='color:darkorange;'><strong>PHP Помилка:</strong> [$errno] $errstr у файлі $errfile на рядку $errline</div>";
    return true; // запобігає стандартному виводу
}
?>