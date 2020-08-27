<?php
// подключаемся к базе
include 'db.php';
include 'Core.php';
$db = new DB(\PDO::FETCH_OBJ);

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если логин или пароль пустой, то выдаем ошибку и останавливаемся
{
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}
//защищаемся от нежелательного говна
$login = Core::clearVar($login);
$password = Core::clearVar($password);
// проверка на существование пользователя с таким же логином
$myRow = $db->fetch("SELECT id FROM users WHERE login = :login", ['login' => $login]);
if (!empty($mRow->id)) {
//    header('Location:/reg.php');
    exit('Пользователь с таким именем уже существует.');
}
// если такого нет, то сохраняем данные

$result2 = $db->execute("INSERT INTO users (`login`, `password`,`status`) VALUES (:login, :password,:status)", ['login' => $login, 'password' => $password, 'status' => 10]);


// Проверяем, есть ли ошибки
if ($result2 == true) {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='index.php'>Главная страница</a>";
} else {
    echo "Вы не зарегистрированы.";
}