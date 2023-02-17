<?php 
session_start();
setcookie('PHPSESSID', session_id(), strtotime('2023-02-16 19:00:00'));

$bd = mysqli_connect("localhost", "root", "", "poll");
// $bd = mysqli_connect("localhost", "root", "TB8j8Ddir5DhKcP", "poll");
if(!$bd) die (mysqli_connect_error());
mysqli_set_charset($bd, "utf8") or die('Не установлена кодировка');


$select = "SELECT * FROM users";
$res_select = mysqli_query($bd, $select);
$members = mysqli_fetch_all($res_select);

$select = "SELECT * FROM games";
$res_select = mysqli_query($bd, $select);
$games = mysqli_fetch_all($res_select);

if (isset($_COOKIE['maxuser'])) {
    echo "<script>alert('Достигнуто максимальное количество игроков')</script>";
    setcookie('maxuser', '', time() - 3600, '/');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Главная</title>
</head>
<body>
    <header class="header">
        <div class="header__container container">
            <h1 class="header__title">опросник</h1>
            <a href="./login/index.php" class="header__link">Войти</a>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="games">
                <article class="game">
                    <div class="game__top">
                        <h2 class="game__title"><?= $games[0][1] ?></h2>
                        <div class="game__top-right">
                            <div class="game__number"><?= $games[0][2] ?></div>
                            <div class="game__time"><?= $games[0][3] ?></div>
                        </div>
                    </div>

                    <div class="game__center">
                        <div class="game__center-left">
                            <div><img class="game__img" src="<?= $games[0][5] ?>" alt="Logo"></div>
                            <p>Количество участников - <?php echo count($members) ?></p>
                            <ul id="users">
                                <?php foreach ($members as $key => $value) { 
                                    echo "<li>{$members[$key][1]}";
                                    if ($members[$key][2] == 'Гейм мастер') {
                                        echo " ({$members[$key][2]})";
                                    }
                                    echo "</li>";
                                } ?>
                            </ul>
                        </div>
                        <div class="game__center-right">
                            <div class="game__about"><p><?= $games[0][4] ?></p></div>
                            <div class="form-block" id='form-block'>
                                <?php if (isset($_SESSION['username']) && isset($_SESSION['member'])) {
                                    echo "{$_SESSION['username']} вы зарегистрированы как {$_SESSION['member']} <a href=\"index.php?do=exit\">Отказаться от участия</a>"; 
                                } else { ?>
                                <form action="" id="user-form" class="form" method="post">
                                    <div class="form__item">
                                        <label class="form__label" for="username">Запишитесь для участия:</label>
                                        <input class="form__username" type="text" name="username" placeholder="Введите ваше имя" required>
                                    </div>
                                    
                                    <div class="form__item">
                                        <input type="radio" id="radio1" name="member" value="Участник" checked>
                                        <label class="form__radio-label"for="radio1">Участник</label>
                                        <input type="radio" id="radio2" name="member" value="Гейм мастер">
                                        <label for="radio2">Гейм мастер</label>
                                    </div>
                                    <div class="form__item">
                                        <input class="form__submit submit game__button" id="add_user" type="submit" value="Отправить" name='submit'>
                                    </div>
                                    <img class="popup__close hidden" src="img/close.svg" alt="">
                                    
                                </form> 
                                <?php } ?>
                            </div>
                            <div class="game__buttons">
                                <button class="game__button" id="rules">Правила игры</button>
                                <button class="game__button hidden" id="participate">Учавствовать</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="popup hidden" id="popup-rules">
                        <div class="game__popup">
                            <p><?= $games[0][6] ?></p>
                            <img class="popup__close" src="img/close.svg" alt="">
                        </div>
                    </div>
                </article>
                <!-- <div class="popup hidden" id="popup-participate">
                    <div class="popup__participate">

                        <form action="" class="form">
                            <div class="form__item">
                                <label class="form__label" for="username">Username:</label>
                                <input class="form__username" type="text" name="username" placeholder="name">
                            </div>
                            
                            <div class="form__item">
                                <input type="radio" id="radio1" name="member" value="member" checked>
                                <label for="radio1">Участник</label>
                                <br>
                                <input type="radio" id="radio2" name="member" value="game-master">
                                <label for="radio2">Гейм мастер</label>
                            </div>
                            <div class="form__item">
                                <input class="form__submit submit" type="submit" value="Записаться" name='submit'>
                            </div>
                            <img class="popup__close" src="img/close.svg" alt="">
                        
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </main>
    <footer class="footer"></footer>
</body>
<script src="js/script.js"></script>
<script src="js/ajax.js"></script>
</html>



