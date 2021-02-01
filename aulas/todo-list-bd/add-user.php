<?php

require 'init.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm-password'];

if ($confirm != $password) {
    header('location: register.php?error=Senhas não conferem&username=' . $username);
    exit();
}

require 'bd.php';

// $users = file('users.csv') ?? [];
// $found = false;
// foreach($users as $raw_user) {
//     // $arr = explode(',', $raw_user);
//     // $user = $arr[0];
//     // $pw = $arr[1];
//     list($user, $pw) = explode(',', $raw_user);
//     if (trim($user) == $username) {
//         $found = true;
//         break;
//     }
// }
// if ($found) {
//     header('location: register.php?error=Username já está em uso&username=' . $username);
//     exit();
// }

// READ
$stmt = $pdo->prepare("
    SELECT * FROM users WHERE username = ?
"); // guarda os dados da consulta (statement) ao SGBD
$stmt->execute([$username]);
if ($stmt->rowCount() > 0) {
    header('location: register.php?error=Username já está em uso&username=' . $username);
    exit();
}

// $newUser = $username . ',' . sha1($password) . "\n";

// $fp = fopen(USERS_FILE, 'a');
// fwrite($fp, $newUser);
// fclose($fp);

// INSERT
$stmt = $pdo->prepare("
    INSERT INTO users (username, password) VALUES (?, ?)
");
$stmt->execute([
    $username,
    sha1($password)
]);

header('location: login.php?msg=Usuário cadastrado com sucesso');

?>