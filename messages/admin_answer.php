<?php
require '../db.php';


$db = new DB(\PDO::FETCH_OBJ);

$id = $_GET['id'];
$answer = $_POST['answer'];

$query = $db->fetch('UPDATE message SET answer = :answer WHERE id=:id',['answer'=>$answer, 'id'=>$id]);

header('Location:/messages/guest-book.php');
?>