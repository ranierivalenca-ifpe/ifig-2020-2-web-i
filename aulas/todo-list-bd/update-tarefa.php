<?php

require 'init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

require 'bd.php';
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$task_id]);

if ($stmt->rowCount() > 0 && $stmt->fetch()['user_id'] == $user_id) {
    $stmt = $pdo->prepare("UPDATE tasks SET finished = true WHERE id = ?");
    $stmt->execute([$task_id]);
}

header('location: /');

?>