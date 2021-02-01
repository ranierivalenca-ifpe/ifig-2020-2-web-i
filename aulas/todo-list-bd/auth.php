<?php

require 'init.php';
require 'bd.php';

$username = $_POST['username'];
$password = sha1($_POST['password']);

// $users = file(USERS_FILE) ?? [];
// foreach($users as $raw_user) {
//     $line = $username . ',' . $password;
//     if (trim($raw_user) == $line) {
//         $_SESSION['user'] = explode(',', $raw_user)[0];
//         header('location: /');
//         exit();
//     }
// }

$stmt = $pdo->prepare("
    SELECT * FROM users WHERE username = ? AND password = ?
");
$stmt->execute([$username, $password]);
$results = $stmt->fetchAll();

if (sizeof($results) > 0) {
   $user = $results[0];
   $_SESSION['user'] = $user['username'];
   $_SESSION['user_id'] = $user['id'];
   header('location: /');
   exit();
}

exit();

header('location: login.php?error=Usuário ou senha incorreto');


?>