<?php
include $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
$db = new DB(\PDO::FETCH_OBJ);

$db = new DB(PDO::FETCH_OBJ);

if(isset($_POST["addToDB"])) {
    $name = ($_POST['name']);
    $email = ($_POST['email']);
    $message = ($_POST['message']);
    $answer = ($_POST['answer']);





    $query = $db->execute("INSERT INTO message(name,email,message) VALUES (:name, :email, :message)",['name' => $name, 'email' => $email,'message' => $message]);

}else{
    echo(' метод POST не прошел');
    exit();
}


header('Location: /messages/guest-book.php');

?>
