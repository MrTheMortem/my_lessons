<?php
require '../db.php';

$id = $_GET['id'];
$answer = $_POST['answer'];

$query = $pdo->prepare('UPDATE message SET answer = :answer WHERE id=:id');
$query->execute(['answer'=>$answer, 'id'=>$id]);

header('Location:/messages/guest-book.php');
?>