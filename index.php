<?php


echo"<h1><br><b>Завдання 2</b><br></h1>";

echo "<pre>Полину в мріях в купель океану,<br>
Відчую <b>шовковистість</b> глибини,<br>
 Чарівні мушлі з дна собі дістану<br>
    Щоб <b><i>взимку</i></b><br>
		<u>тішили</u><br>
			мене<br>
				вони…<br></pre>";



echo"<h1><br><br><br><br><b>Завдання 3</b><br></h1>";

$KyrsUSD = 41.73;
$UAH = mt_rand(10, 1000000);
$res = $UAH/$KyrsUSD;
$res = round($res, 2);
echo"UAH = $UAH грн<br>
KyrsUSD = 41.73$<br>
Результат: UAH/KyrsUSD = $res$";



echo"<h1><br><br><br><br><b>Завдання 4</b><br></h1>";


$month = mt_rand(1, 12);
echo"Номер місяця: $month<br>Сезон: ";

if ($month == 12 || $month == 1 || $month == 2) {
    echo "Зима\n";
} else if ($month == 3 || $month == 4 || $month == 5) {
    echo "Весна\n";
} else if ($month == 6 || $month == 7 || $month == 8) {
    echo "Літо\n";
} else if ($month == 9 || $month == 10 || $month == 11) {
    echo "Осінь\n";
} else 
    echo "Помилка";




echo"<h1><br><br><br><br><b>Завдання 5</b><br></h1>";


$alfavit = range('a', 'z');
$letter = $alfavit[array_rand($alfavit)];


echo"Літера: <b>".$letter."</b> є ";


switch ($letter) {
    case 'a':
    case 'e':
    case 'i':
    case 'o':
    case 'u':
    case 'y':
        echo "голосною буквою.<br>";
        break;
    default:
        echo "приголосною буквою.\n<br>";
        break;
}




echo"<h1><br><br><br><br><b>Завдання 6</b><br></h1>";


$number = mt_rand(100,999);
echo "Випадкове число: $number<br>";

$num1 = (int)($number/100);
$num2 = (int)(($number - 100*$num1)/10);
$num3 = $number - 100*$num1 - 10*$num2;

echo "Сума цифр: ".$num1 + $num2 + $num3."<br>";


$revNum = $num3 * 100 + $num2 * 10 + $num1;

echo"Число у зворотному порядку: $revNum <br>";

$arr = [$num1, $num2, $num3];

sort($arr);

$bigNum = $arr[2]*100 + $arr[1]*10 + $arr[0];

echo "Найбільше можливе число: $bigNum";




echo"<h1><br><br><br><br><b>Завдання 7</b><br></h1>";

function colorRGB() {
    $r = mt_rand(0, 255);
    $g = mt_rand(0, 255);
    $b = mt_rand(0, 255);
    return "rgb($r, $g, $b)";
}

function generTable($rows, $cols) {
    echo"<h3>Згенерована таблиця розміром $rows"."x"."$cols<br><h3>"; 
    echo "<table border='1' cellspacing='0' cellpadding='10'   >";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            echo "<td style='background-color: ".colorRGB().";?>;'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


generTable(mt_rand(3,20), mt_rand(3,20));


function generRed($n) {
    echo "<div style='position: relative; width: 100vw; height: 100vh; background-color: black; top: 20; right: 10' >";
    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(10, 100); 
        $x = mt_rand(0, 90); 
        $y = mt_rand(0, 90); 
        
        echo "<div style='
            position: absolute;
            width: {$size}px;
            height: {$size}px;
            background-color: red;
            top: {$y}%;
            left: {$x}%;
            '></div>";
    }
    echo "<h1 style='color: grey; text-align: center;'> Виведено $n червоних квадратів </h1>";
    echo "</div>";
}

generRed(mt_rand(3,20));

?>

