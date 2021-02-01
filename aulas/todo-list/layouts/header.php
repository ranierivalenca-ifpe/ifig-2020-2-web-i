<?php require_once 'init.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800">
    <main class="max-w-7xl bg-white mx-auto min-h-screen">
        <nav class="w-full bg-yellow-500 px-2 py-4">
            <div class="grid grid-cols-2">
                <h1 class="text-xl">
                    <a href="/">Lista de tarefas</a>
                </h1>
                <div class="text-right">
                    <?php if (isset($_SESSION['user'])): ?>
                        <strong><?= $_SESSION['user'] ?></strong> - <a href="logout.php">Sair</a>
                    <?php else: ?>
                        <a class="color-gray-600 hover:color-gray-400" href="/login.php">Login</a>
                    <?php endif ?>
                </div>
            </div>
        </nav>
        <div class="p-2">

