<?php


require_once 'autoload.php';



echo "<h1>Завдання 1, 2, 3, 4, 5</h1>";

$views = new Views\UserView();
$views->message('yспішно підключений.');

$models = new Models\UserModel();
echo $models->getMessage();

$controller = new Controllers\UserController();
$controller->showMessage();

echo "<h1>Завдання 5</h1>";

$circle1 = new Circle(0, 0, 2);

$circle2 = new Circle();

echo 'Перше ' . $circle1->__toString() . '<br>';

$circle2->setX(2);
$circle2->setY(2);
$circle2->setRadius(5);

echo 'Друге ' . $circle2 . '<br>';


echo '<h1>Завдання 6</h1>';

if (($circle1->intersects($circle2)))
    echo 'Дані поля перетинаються';
else
    echo 'Дані не поля перетинаються';


echo '<h1>Завдання 7</h1>';


Text::clearFile('text1');
Text::clearFile('text2');
Text::clearFile('text3');

Text::writeFile('text1', 'Текст для з файлу text1');
Text::writeFile('text2', 'Текст для з файлу text2');
Text::writeFile('text3', 'Текст для з файлу text3');

echo Text::readFile('text1') . "<br>";
echo Text::readFile('text2') . "<br>";
echo Text::readFile('text3') . "<br>";

echo "<h1>Завдання 8, 9, 10</h1><br>";

$student = new Student("Віталій", 22, "Державний університет Житомирська політехніка", 2);

$student->getDataStudent($student);

$student->setAge(23);
$student->setUniversity("Житомирська політехніка");
$student->nextCourse();

$student->getDataStudent($student);


$student->birth();
$student->cleanRoom();
$student->cleanKitchen();


$programmer = new Programmer("Віталій", 22, 1);
$programmer->addProgrammingLanguage("PHP");
$programmer->addProgrammingLanguage("C#");
$programmer->addProgrammingLanguage("Python");
echo "<br>Дані про програміста:<br>
Ім'я: ". $programmer->getName() . "<br>
Вік: " . $programmer->getAge() . "<br>
Програміст знає мови: " . implode(", ", $programmer->getProgrammingLanguages()) . "<br>
Стаж програмування: " . $programmer->getExperience()." рік<br><br>";

$programmer->birth();
$programmer->cleanRoom();
$programmer->cleanKitchen();











