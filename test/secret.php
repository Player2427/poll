<?php 
session_start();

if ( isset($_SESSION['name'] ) && $_SESSION['name'] == 'admin') {
    echo "Добро пожаловать";
} else {
    echo "Вы не авторизованы";
    die;
}

// if ( !isset($_SESSION['name']) ) die("Вы не авторизованы");

// echo "Добро пожаловать {$_SESSION['name']}"


?>
<ul>
    <li><a href="sess1.php">sess1</a></li>
    <li><a href="sess2.php">sess2</a></li>
    <li><a href="secret.php">secret</a></li>
</ul>