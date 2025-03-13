<?php

class Text {
    private static string $dir = 'text';
    public static function writeFile(string $filename, string $content) {
        file_put_contents(self::$dir . "/" . $filename, $content, FILE_APPEND);
    }
    public static function readFile(string $filename): string {
        return file_get_contents(self::$dir . "/" . $filename);
    }

    public static function clearFile(string $filename) {
        file_put_contents(self::$dir . "/" . $filename, '');
    }
}