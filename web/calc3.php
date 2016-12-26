<?php

$filetmpname = $_FILES['fileToUpload']['tmp_name'];
$filename = $_FILES['fileToUpload']['name'];

echo $filename.'<br>';
echo $filetmpname;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/main.css?1"/>
    <title>Вторая страница</title>
</head>

<body>
    <div>Ну хоть сюда ты зашел</div>
<!--<input type="button" value="Сравнить">-->



</body>
</html>
