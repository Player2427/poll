<?php 
session_start();
define('LOGIN', 'admin');
define('PASSWORD', 'Aa12345');
$_SESSION['login_status'] = 'off'; 

if ( !empty($_POST) ) {
    if ($_POST['login'] === LOGIN && $_POST['password'] === PASSWORD) {
        $_SESSION['login_status'] = 'on';
        header("Location: ../admin_panel/index.php");
        die();
    } else {
        $_SESSION['login_not'] = 'Неверный логин или пароль';
        header("Location: index.php");
        die();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Вход</title>
</head>

<body>
    <form action="" class="login-form" method="post">
        <div class="login-form__item">
            <label class="login-form__label" for="login">Логин:</label>
            <input class="login-form__input" type="text" name="login" required>
        </div>
        <div class="login-form__item">
            <label class="login-form__label" for="password">Пароль:</label>
            <input class="login-form__input" type="password" name="password" required>
        </div>
        <div>
            <?php if (isset($_SESSION['login_not'])) {
            echo $_SESSION['login_not'];
            unset($_SESSION['login_not']);
            }?>
        </div>
        <button class="login-form__button" type="submit">Войти</button>
    </form>

</body>