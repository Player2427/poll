<?php
session_start();
$bd = mysqli_connect("localhost", "root", "", "poll");
// $bd = mysqli_connect("localhost", "root", "TB8j8Ddir5DhKcP", "poll");
if(!$bd) die (mysqli_connect_error());
mysqli_set_charset($bd, "utf8") or die('Не установлена кодировка');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete = "DELETE FROM `users` WHERE username='{$_SESSION['username']}'";
    $query_res = mysqli_query($bd, $delete);
    session_unset();

    echo json_encode($data);
}
?>