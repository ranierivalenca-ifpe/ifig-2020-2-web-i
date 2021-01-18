<?php

header('minha mensagem: estamos contratando');

if (!is_file('func.csv')) {
    fopen('func.csv', 'w');
}
$funcionarios = file('func.csv');
for ($i = 0; $i < sizeof($funcionarios); $i++) {
    $funcionarios[$i] = explode(',', $funcionarios[$i]);
}
// echo "<pre>";
// var_dump($funcionarios);
// echo "</pre>";
// $funcionarios = array_map(function($el) {
//     return explode(',', $el);
// }, $funcionarios);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, tr, th, td {
            border: 1px solid #aaa;
            border-collapse: collapse;
        }
        td, th {
            padding: .5em;
        }
        tr:nth-child(even) {
            background: hsl(0, 0%, 90%);
        }
        table {
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <h1>Sistema de funcionários</h1>
    <h2>Lista de funcionários</h2>

    <table>
        <tr>
            <th>cpf</th>
            <th>nome</th>
            <th>sobrenome</th>
            <th>email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($funcionarios as $linha => $func): ?>
            <tr>
                <td><?= $func[0] ?></td>
                <td><?= $func[1] ?></td>
                <td><?= $func[2] ?></td>
                <td><?= $func[3] ?></td>
                <td>
                    <a href="delete_func.php?linha=<?= $linha ?>">Deletar</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <form action="adicionar_func.php" method="POST">
        <fieldset>
            <legend>Adicionar funcionário</legend>
            <input type="text" name="cpf" placeholder="CPF">
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="sobrenome" placeholder="Sobrenome">
            <input type="text" name="email" placeholder="Email">
            <input type="submit" value="adicionar">
        </fieldset>
    </form>
</body>
</html>