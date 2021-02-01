<?php

require 'init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$id = $_GET['id'];
// $user = $_SESSION['user'];
$user_id = $_SESSION['user_id'];

// $tasks = file(TASKS_FILE);
// $taskToRemove = $tasks[$id];
// if (trim(explode(',', $taskToRemove)[0]) != $user) {
//     header('location: /');
//     exit();
// }

// $tasks[$id] = ",\n";

// file_put_contents(TASKS_FILE, implode('', $tasks));

require 'bd.php';
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);

// $stmt->fetch() == $stmt->fetchAll()[0]
if ($stmt->rowCount() > 0 && $stmt->fetch()['user_id'] == $user_id) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
}
header('location: /');

?>