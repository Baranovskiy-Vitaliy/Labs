<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        td{
            text-align: center;
        }
    </style>
</head>

<body>


    <form action="calculate.php" method="post">
        <table>
            <tr>
                <td>
                    <h3>X</h3>
                </td>
                <td>
                    <h3>Y</h3>
                </td>
            </tr>
            <tr>
                <td><input type="number" name="x" required value="<?php echo isset($_SESSION['x']) ? $_SESSION['x'] : ""; ?>"></td>
                <td><input type="number" name="y" required value="<?php echo isset($_SESSION['y']) ? $_SESSION['y'] : ""; ?>"></td>
                <td><input type="submit" step="1" value="        =      "></td>
            </tr>
        </table>

    </form>

<br><br><br>
<a href="../indexLab2.php">Повернутись на головну сторінку</a>

</body>

</html>