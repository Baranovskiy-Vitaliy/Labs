<?php 
session_start();

if (isset($_POST['x']) && isset($_POST['y'])){
    $x = (int)($_POST['x']);
    $y = (int)($_POST['y']);
    $_SESSION['x'] = $_POST['x'];
    $_SESSION['y'] = $_POST['y'];
}
else{
    $x = 0;
    $y = 0;
}

include("function/fun.php");



?>



<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя перша сторінка</title>
    <style>
        table{
            border-collapse: collapse;
        }
        th{
            background-color: yellow;
        }
        th, td {
        font-size: 18px;  
        padding: 10px;     
        text-align: center; 
        border: 1px solid black; 
    }
    </style>
</head>
<body>

    <table>
        
        <tr>
            <th>x^y</th>
            <th>x!</th>
            <th>sin()</th>
            <th>cos()</th>
            <th>tg()</th>
        </tr>
        <tr>
            <td><?php echo myPow($x, $y); ?></td>
            <td><?php echo myFact($x); ?></td>
            <td><?php echo mySin($x); ?></td>
            <td><?php echo myCos($x); ?></td>
            <td><?php echo myTan($x); ?></php></td>
            <td>X: <?php echo $x; ?></td>
        </tr>
        <tr>
            <td><?php echo myPow($y, $x); ?></td>
            <td><?php echo myFact($y); ?></td>
            <td><?php echo mySin($y); ?></td>
            <td><?php echo myCos($y); ?></td>
            <td><?php echo myTan($y); ?></php></td>
            <td>Y: <?php echo $y; ?></td>
        </tr>

    </table>
    
    <a href="task4.php">Змінити данні</a>

    
</body>
</html>