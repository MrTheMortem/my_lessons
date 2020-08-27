<?php
include $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
$db = new DB(\PDO::FETCH_OBJ);

if(isset($_GET['id'])){
    echo'Значение id сообщения не установлено';
}
$id = $_GET['id'];

$db->execute('DELETE FROM message WHERE id= ?', ['id' => $id]);

header('Location:/messages/guest-book.php');
?>