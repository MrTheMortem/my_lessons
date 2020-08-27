<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Гостевая книга</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Гостевая книга</h1>

<div class="comment">

    <?php
    $db = new DB(\PDO::FETCH_OBJ);
    //постраничная навигация
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = (int)preg_replace('/[^0-9]/', '', $page);
    if (!$page) {
        $page = 1;
    }
    $notesOnPage = 5;
    $from = ($page - 1) * $notesOnPage;
    $query = "SELECT * FROM `message` WHERE `id` LIMIT {$from}, {$notesOnPage}";
    if (isset($_SESSION['status'])) {

        if ($_SESSION['status'] == 1) {
            foreach ($db->fetchAll($query) as $row) {
                echo '<form><label>' . $row->name . '</label><br>
        <br>
        <label>' . $row->email . '</label><br>
        <textarea>' . $row->message . '</textarea></form>
        <label>' . $row->created_at . '</label>
        <a href="delete_message.php?id=' . $row->id . '"><button>Удалить</button></a>
        <form action="admin_answer.php?id=' . $row->id . '" method="post" >
        <textarea name="answer">' . $row->answer . '</textarea>
        <button>Комментировать</button></form>';

            }
        }
    }        // для пользователей

    if (!isset($_SESSION['status']) || $_SESSION['status'] == 10) {
        foreach ($db->fetchAll($query) as $row) {
            echo '<form><ul><label>' . $row->name . '</label><br>
        <label>' . $row->created_at . '</label></ul>
        <textarea>' . $row->message . '</textarea></form>';
            if ($row->answer == true) {
                echo '<textarea>' . $row->answer . '</textarea>';
            }
        }
    }


    ?>
</div>

<form name="message" action="add.php" method="post">
    <!-- User Name-->
    <label>Имя:</label><br>
    <input type="text" name="name" placeholder="Имя"><br>
    <!-- E-mail(for admin) -->
    <label>E-mail:</label><br>
    <input type="text" name="email" placeholder="E-mail"><br>
    <!-- Comment of user-->
    <textarea name="message" cols="40" rows="5" placeholder="Комментарий:"></textarea><br>
    <button name="addToDB" type="submit">Отправить</button>
    <br>
    <br>

    <?php
    // постраничная навигация
    $totalCount = $db->rowCount('SELECT message FROM message');
    $totalPages = (int)ceil($totalCount / $notesOnPage);
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($page === $i);
        if ($i === 1) {
            echo '<a href="./guest-book.php?page=1" style="margin-right: 6px;">Первая</a>';
            if ($page - 1 > 1) {
                echo '<a href="/guest-book.php?page=' . ($page - 1) . '" style="margin-right: 6px;">Сюда</a>';
            }
        }
        echo '<a href="./guest-book.php?page=' . $i . '" style="margin-right: 6px;' . ($active ? ' font-weight: bold;' : '') . '">' . $i . '</a>';
        if ($i === $totalPages) {
            if ($page + 1 < $totalPages) {
                echo '<a href="./guest-book.php?page=' . ($page + 1) . '" style="margin-right: 6px;">Туда</a>';
            }
            echo '<a href="/guest-book.php?page=' . $totalPages . '">Последняя</a>';
        }
    }
    ?>
    <br/>
    <a href="../index.php">Дом</a>
</form>
<footer>

</footer>
</body>
</html>