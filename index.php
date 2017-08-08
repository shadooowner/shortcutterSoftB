<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$db = new PDO('mysql:host=localhost;dbname=co27683_short', 'co27683_short', '12345');
if(isset($_GET['i'])){
    $key = $_GET['i']; //Получить ID ссылки
    $linkSeri = $db->query('SELECT * FROM `links` WHERE `key_` ="'.$key.'"'); //Выбрать ссылку по ID
    $linkRow = $linkSeri->fetchAll(PDO::FETCH_OBJ); //Преобразовать полученное в объект
    header("Location: ".$linkRow[0]->link);//Переместить по ссылке
}
?>



<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Сокращатель</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div class="wrapper">
    <?php
    if(isset($_GET['link'])){
        $keyGet=(file_get_contents('http://www.sethcardoza.com/api/rest/tools/random_password_generator/complexity:alpha')); //Взять рандомный текст для получения нового ID для ссылки
        $db->query('INSERT INTO `links` (`link`,`key_`) VALUES ("http://'.$_GET['link'].'","'.$keyGet.'")'); //Добавляем пару ключ-значение

        echo('<p>Ссылка: <a href="http://'.$_SERVER['HTTP_HOST'].'/?i='.$keyGet.'">http://'.$_SERVER['HTTP_HOST'].'/?i='.$keyGet.'</a></p>'); //Выводим ссылку по ключу
        die();
    }
    ?>
    <form action="index.php">
        <p>http://</p>
        <input type="text" placeholder="ссылка" name="link">
        <input type="submit" value="отправить">
    </form>
</div>
</body>