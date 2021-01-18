<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    $pessoas = file('dados.csv');
    for ($i = 0; $i < sizeof($pessoas); $i++) {
        $pessoas[$i] = explode(',', $pessoas[$i]);
    }
?>
<body>
    <table>
        <tr> <!-- table row -->
            <th>Nome</th> <!-- table head -->
            <th>Sobrenome</th>
        </tr>
        <?php foreach ($pessoas as $pessoa): ?>
            <tr>
                <td><?= $pessoa[0] ?></td>
                <td><?= $pessoa[1] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <a href="form-example.html">Adicionar</a>
</body>
</html>