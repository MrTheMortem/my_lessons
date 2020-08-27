<?php
include $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
$db = new DB(\PDO::FETCH_OBJ);


$db = new DB(\PDO::FETCH_OBJ);

$id = $_GET['id'];
$answer = $_POST['answer'];

$db->execute('UPDATE message SET answer = :answer WHERE id=:id', ['answer' => $answer, 'id' => $id]);
header('Location:/messages/guest-book.php');
?>