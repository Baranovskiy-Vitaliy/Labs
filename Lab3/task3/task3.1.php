<?php 

$filename = "comments.txt";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    if(!empty($name) && !empty($comment)){
        $sql = $name ."|". $comment ."\n";
        $file = fopen($filename, "a");
        fwrite($file, $sql);
        fclose($file);

        header("Location: " . $_SERVER['PHP_SELF']);
        die;
    }
}

function readComments($filename){
    $comments = [];
    if(file_exists($filename)){
        $file = fopen($filename,"r");
        while(( $line = fgets($file)) !== false) {
            $line = explode("|", trim($line));
            if(count($line) == 2){
                $comments[] = ["name" => $line[0],"comment"=> $line[1]];
            }
        }
    fclose($file);
    }
    return $comments;
}

$comments = readComments($filename);

?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма коментарів</title>
</head>
<body>

<h2>Залиште коментар</h2>
<form action="" method="post">
    <table>
        <tr>
            <th>Ім'я:</th>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <th>Коментар:</th>
            <td><textarea name="comment" rows="4" required></textarea></td>
        </tr>
        <tr><td><button type="submit">Надіслати</button></td></tr>
    </table>
    
</form>

<h2>Всі коментарі</h2>
<?php if (!empty($comments)) : ?>
    <table>
        <tr>
            <th>Ім'я</th>
            <th>Коментар</th>
        </tr>
        <?php foreach ($comments as $c) : ?>
        <tr>
            <td><?= htmlspecialchars($c["name"]) ?></td>
            <td><?= nl2br(htmlspecialchars($c["comment"])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Поки що немає коментарів.</p>
<?php endif; ?>

</body>
</html>