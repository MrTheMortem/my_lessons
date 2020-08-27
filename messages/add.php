<?php
    require '../db.php';

if(isset($_POST["addToDB"])) {
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $message = ($_POST['message']);
    $answer = ($_POST['answer']);


    require '../db.php';

    $query = $pdo->prepare("INSERT INTO message(name,email,message) VALUES (:name, :email, :message)");
    $query->execute(['name' => $name, 'email' => $email,'message' => $message]);

}else{
    echo(' метод POST не прошел');
    exit();
}


header('Location: /messages/guest-book.php');

?>
