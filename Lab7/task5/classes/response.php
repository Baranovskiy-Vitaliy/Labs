<?php

class Response
{
    private int $statusCode = 200;
    private array $headers = [];

    // Встановлення HTTP-статусу
    public function setStatus(int $code): void
    {
        $this->statusCode = $code;
    }

    // Додавання заголовку
    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    // Відправлення відповіді
    public function send(string $content): void
    {
        // Очищення буфера виводу
        if (ob_get_length()) {
            ob_clean();
        }

        // Встановлення статусу
        http_response_code($this->statusCode);

        // Встановлення заголовків
        foreach ($this->headers as $header) {
            header($header);
        }

        // Вивід контенту
        echo $content;

        // Завершення виконання скрипта
        exit;
    }
}