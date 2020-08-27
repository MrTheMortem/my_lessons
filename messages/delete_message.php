<?php
require '../db.php';

if(isset($_GET['id'])){
    echo'Значение id сообщения не установлено';
}
$id = $_GET['id'];

$query = $pdo->prepare('DELETE FROM message WHERE id= ?');
$query->execute([$id]);

header('Location:/messages/guest-book.php');
?>