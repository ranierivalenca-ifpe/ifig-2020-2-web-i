<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    $funkos = [
        ['EVA 01', 'Evangelion', 'Super'],
        ['Kyubi', 'Naruto', 'Flocked'],
        ['Goku', 'Dragon Ball Z', ''],
        ['Growlithe', 'Pokemon', '']
    ];
    // $nome = "10.34";
    // echo "<pre>"; // html - pre formatted
    // var_dump($funkos);
    // // // print_r($funkos);
    // echo "</pre>";
?>
<body>
    <table>
        <tr> <!-- table row -->
            <th>Personagem</th> <!-- table head -->
            <th>Universo</th>
        </tr>
        <?php foreach ($funkos as $funko): ?>
            <tr>
                <td><?= $funko[0] ?></td>
                <td><?= $funko[1] ?></td>

                <!-- <?php foreach ($funko as $dado): ?> -->
                    <!-- <td><?= $dado ?></td> -->
                <!-- <?php endforeach ?> -->
            </tr>
        <?php endforeach ?>
        <!-- <tr>
            <td>EVA 01</td>
            <td>Evangelion</td>
        </tr>
        <tr>
            <td>Kyubi</td>
            <td>Naruto</td>
        </tr>
        <tr>
            <td>Goku</td>
            <td>Dragon Ball</td>
        </tr> -->
    </table>
</body>
</html>