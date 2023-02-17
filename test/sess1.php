<?php 
session_start();
define('ADMIN', 'admin');

if (!empty($_POST['name'])) {
    if ($_POST['name'] === ADMIN) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['login'] = 'Вы успешно вошли';
    } else {
        $_SESSION['login'] = 'Неверный логин';
    }
    header("Location: sess1.php");
    die;
}

?>

<ul>
    <li><a href="sess1.php">sess1</a></li>
    <li><a href="sess2.php">sess2</a></li>
    <li><a href="secret.php">secret</a></li>
</ul>

<form action="" method="post">
    <input type="text" name="name">
    <button type="submit">Войти</button>
</form>

<?php if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}