<?php

require 'init.php';

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$id = $_GET['id'];
$user = $_SESSION['user'];

$tasks = file(TASKS_FILE);
$taskToRemove = $tasks[$id];
if (trim(explode(',', $taskToRemove)[0]) != $user) {
    header('location: /');
    exit();
}

$tasks[$id] = ",\n";

file_put_contents(TASKS_FILE, implode('', $tasks));
header('location: /');

?>