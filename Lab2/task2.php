<?php
session_start();


//Завдання 2.1
echo "<h1>Завдання 2.1</h1>";

function searchRepeat(array $arr) {
    $counts = array_count_values($arr);
    //print_r($counts);
    $cleanArray = array_filter($counts, function ($count) {
        return $count > 1;
    });
    
    return array_keys($cleanArray);
}


$array1 = array_map(function() {
    return mt_rand(0, 9);
}, range(1, 12));

$result = searchRepeat($array1);



echo "Згенерований масив: " . json_encode($array1) . "<br>";
echo "Елементи що повторювались: " . json_encode($result) . "<br><br><br>";




//Завдання 2.2
echo "<h1>Завдання 2.2</h1>";

function generatePetName(array $syllables, int $length = 3): string {
       
    $name = "";
    for ($i = 0; $i < $length; $i++) {
        $name .= $syllables[array_rand($syllables)];
    }
    
    return ucfirst($name);
}



$array2 = ["mi", "ka", "to", "lu", "ba", "ri", "zo", "chi"];

echo "Згенероване ім'я: " . generatePetName($array2, 2) . "<br><br><br>"; 


//Завдання 2.3
echo "<h1>Завдання 2.3</h1>";


// function createArray() {
//     $length = rand(3, 7); 
//     $array = [];
//     for ($i = 0; $i < $length; $i++) {
//         $array[] = rand(10, 20); 
//     }
//     return $array;
// }


function createArray(){
    $array = array_map(function() {
        return mt_rand(10, 20);
    }, range(1, mt_rand(3, 7)));


    return $array;
}



function sumArrays($array1, $array2) {
    $sumArray = array_merge($array1, $array2); 
    $cleanArray = array_unique($sumArray);   
    sort($cleanArray);                          
    
    return $cleanArray;
}

$array3 = createArray();
$array4 = createArray();

echo "Масив 1: " . implode(", ", $array3) . "<br>";
echo "Масив 2: " . implode(", ", $array4) . "<br>";


$resultArray = sumArrays($array3, $array4);


echo "Оброблений масив: " . implode(", ", $resultArray) . "<br><br>";


//Завдання 2.4
echo "<h1>Завдання 2.4</h1>";
$users = [
    "Іван" => mt_rand(18, 60),
    "Марія" => mt_rand(18, 60),
    "Олександр" => mt_rand(18, 60),
    "Олена" => mt_rand(18, 60),
    "Валентин" => mt_rand(18, 60),
    "Юлія" => mt_rand(18, 60),
    "Владислав" =>mt_rand(18, 60),
];

function sortUsers($array, $sortBy) {
    if ($sortBy == 'name') {
        ksort($array);
    } elseif ($sortBy == 'age') {
        asort($array);
    }
    return $array;
}

$sortedByName = sortUsers($users, 'name');
$sortedByAge = sortUsers($users, 'age');


echo "<br>Сортування за іменами:<br>";
print_r($sortedByName);

echo "<br>Сортування за віком:<br>";
print_r($sortedByAge);