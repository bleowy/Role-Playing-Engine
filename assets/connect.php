<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=engine;encoding=utf8', 'root', '');
}catch(PDOException $e)
{
    echo 'Connection Error, better check connection.php!';
}

?>