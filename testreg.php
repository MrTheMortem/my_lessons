<?php
session_start();//  запуск сессии в самом начале кода страницы, иначе хуй в жопу
// подключаемся к базе
include 'db.php';
include 'Core.php';
$db = new DB(\PDO::FETCH_OBJ);
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
} //заносим логин в переменную $login, если он пустой, то уничтожаем переменную

if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то он пидорас и идёт нахер=)
{
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}
//защищаем ввод от пидорасов
$login = Core::clearVar($login);
$password = Core::clearVar($password);
$myRow = $db->fetch("SELECT * FROM users WHERE login=:login", ['login' => $login]);

if (empty($myRow->password)) {
    //если пользователя с введенным логином не существует
    exit ("Извините, введённый вами login или пароль неверный.");
} else {
    //если существует, то сверяем пароли
    if ($myRow->password == $password) {
        //если пароли совпадают, то запускаем сессию
        $_SESSION['login'] = $myRow->login;
        $_SESSION['id'] = $myRow->id;               //эти данные запихиваем в сессию и таскаем с собой
        $_SESSION['status'] = $myRow->status;

        echo "Вы успешно вошли на сайт! <a href='messages/guest-book.php'>Гостевая книга</a>";
    } else {
        //если пароли не сошлись

        exit ("Извините, введённый вами login или пароль неверный.");
    }
}
?>
