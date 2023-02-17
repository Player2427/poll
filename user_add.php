<?php
session_start();
$bd = mysqli_connect("localhost", "root", "", "poll");
// $bd = mysqli_connect("localhost", "root", "TB8j8Ddir5DhKcP", "poll");
if(!$bd) die (mysqli_connect_error());
mysqli_set_charset($bd, "utf8") or die('Не установлена кодировка');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $select = "SELECT * FROM users";
    $res_select = mysqli_query($bd, $select);
    $members = mysqli_fetch_all($res_select);
    if (count($members) < 6) {
        $data = $_POST;
        $username = htmlspecialchars($_POST['username']);
        $_SESSION['username'] = $username;
        $_SESSION['member'] = $_POST['member'];
        $insert = "INSERT INTO `users` (`username`, `member`) VALUE ('$username', '{$_POST['member']}')";
        $res_insert = mysqli_query($bd, $insert);

        echo json_encode($data);
        exit();
    } else {
        setcookie('maxuser', 'yes', time() + 3600, '/');
    }
}
?>