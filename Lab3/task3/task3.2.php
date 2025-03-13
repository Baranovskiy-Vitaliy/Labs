<?php
session_start();
$_POST['formType'] = null;
function readFileContents($filename)
{
    $contents = file_get_contents($filename);
    $words = preg_split('/\s+/', $contents); // Розбиваємо вміст файлу на слова
    return array_count_values($words);
}

$file1 = 'textFile1.txt';
$file2 = 'textFile2.txt';

$file1Contents = file_get_contents($file1);

$file1WordsArray = preg_split('/\s+/', $file1Contents);
echo "<h2>textFile1.txt:</h2>";
echo implode(" ", $file1WordsArray);
echo "<h2>textFile1.txt:</h2>";
echo file_get_contents('textFile2.txt');

sort($file1WordsArray);


$file1Words = readFileContents($file1);
$file2Words = readFileContents($file2);



$uniqueToFile1 = array_diff_key($file1Words, $file2Words);


$commonWords = array_intersect_key($file1Words, $file2Words);


$moreThanTwoInFile1 = array_filter($file1Words, fn($count) => $count > 2);
$moreThanTwoInFile2 = array_filter($file2Words, fn($count) => $count > 2);


    file_put_contents('uniqueToFile1.txt', implode(' ', array_keys($uniqueToFile1)));

    file_put_contents('commonWords.txt', implode(' ', array_keys($commonWords)));

    file_put_contents('moreThanTwoInFile1.txt', implode(' ', array_keys($moreThanTwoInFile1)));

    file_put_contents('moreThanTwoInFile2.txt', implode(' ', array_keys($moreThanTwoInFile2)));


if (file_exists('uniqueToFile1.txt')) {
    echo "<h4>uniqueToFile1.txt:</h4>";
    echo file_get_contents('uniqueToFile1.txt');
}
if (file_exists('commonWords.txt')) {
    echo "<h4>commonWords.txt:</h4>";
    echo file_get_contents('commonWords.txt');
}
if (file_exists('moreThanTwoInFile1.txt')) {
    echo "<h4>moreThanTwoInFile1.txt:</h4>";
    echo file_get_contents('moreThanTwoInFile1.txt');
}
if (file_exists('moreThanTwoInFile2.txt')) {
    echo "<h4>moreThanTwoInFile2.txt:</h4>";
    echo file_get_contents('moreThanTwoInFile2.txt');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fileToDelete']) && $_POST['formType'] == 'Delete') {
    $fileToDelete = $_POST['fileToDelete'];
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "Файл $fileToDelete був успішно видалений.";
        $_SESSION[$fileToDelete] = 1;
    } else {
        echo "Файл не знайдено.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fileToDelete']) && $_POST['formType'] == 'Ref') {
    session_unset();
}

echo "<h4>Відсортовані слова з textFile1.txt:</h4>";
echo implode(" ", $file1WordsArray);

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення файлів</title>
</head>

<body>
    <h1>Вибір файлу для видалення</h1>


    <form method="POST">
        <!-- <label for="fileToDelete">Виберіть файл для видалення:</label> -->

        <label>Введіть ім'я файлу для видалення:</label>
        <input type="text" name="fileToDelete">
        <!-- <option value="uniqueToFile1.txt">uniqueToFile1.txt</option>
            <option value="commonWords.txt">commonWords.txt</option>
            <option value="moreThanTwoInFile1.txt">moreThanTwoInFile1.txt</option>
            <option value="moreThanTwoInFile2.txt">moreThanTwoInFile2.txt</option> -->
        <input type="hidden" name="formType" value="Delete">
        <button type="submit">Видалити</button>
    </form>

    <form method="POST">
        <input type="hidden" name="formType" value="Ref">
        <button type="submit">Оновити</button>
    </form>
</body>

</html>