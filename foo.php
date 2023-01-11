<?php
 include 'db.php';
$name = $_POST['name'];
$note = $_POST['note'];
$get_id = $_GET['id'];



//CREATE

if (isset($_POST['add'])) {
    $sql = ("INSERT INTO users (name, note) VALUES (?,?)");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $note]);
    if ($query) {
        header ("Location: ". $_SERVER['HTTP_REFERER']);
    }
}

//READ

$sql = $pdo->prepare("SELECT * FROM users");
$sql->execute();
$result=$sql->fetchAll(PDO::FETCH_OBJ);

//UPDATE

if (isset($_POST['edit'])) {
    $sql = ("UPDATE users SET name=?, note=? WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$name, $note, $get_id]);
    if ($query) {
        header ("Location: ". $_SERVER['HTTP_REFERER']);
    }
}

//DELETE

if (isset($_POST['delete'])) {
    $sql = ("DELETE FROM users WHERE id=?");
    $query = $pdo->prepare($sql);
    $query->execute([$get_id]);
    if ($query) {
        header ("Location: ". $_SERVER['HTTP_REFERER']);
    }
}

if(isset($_POST['like'])) {

    $sql = ("UPDATE `users` SET likes = likes + 1 WHERE `id` = ?");
    $query = $pdo -> prepare($sql);
    $query-> execute([$_GET['id']]);
    header('Location: index.php');

}

if(isset($_POST['dislike'])) {

    $sql = ("UPDATE `users` SET `dislikes` = `dislikes` + 1 WHERE id = ?");
    $query = $pdo->prepare($sql);
    $query->execute([$_GET['id']]);
    header('Location: index.php');
}




