<?php

require 'init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$task = $_POST['task'];
// $user = $_SESSION['user'];

// $newTask = $user . ',' . $task . "\n";

// $fp = fopen(TASKS_FILE, 'a');
// fwrite($fp, $newTask);
// fclose($fp);
require 'bd.php';
$stmt = $pdo->prepare("
    INSERT INTO tasks (task, user_id) VALUES (?, ?)
");
$stmt->execute([$task, $_SESSION['user_id']]);

header('location: /');

?>