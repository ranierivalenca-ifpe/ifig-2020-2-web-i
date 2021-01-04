<!-- C-like -->
<?php
    $a = 10;
    $b = 20;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="font-size: <?php print($a + $b); ?>">Hello PHP</h1>
    <ul>
        <?php
            for ($i = 0; $i < $a; $i++) {
                if ($i % 2 == 0) {
                    echo "<li><strong>" . $i . "</strong></li>";
                } else {
                    echo "<li>$i</li>";
                }
            }
        ?>
    </ul>
    <ul>
        <?php for ($i = 0; $i < $a; $i++): ?>
            <?php if ($i % 2 == 0): ?>
                <li><strong><?php echo $i ?></strong></li>
            <?php else: ?>
                <li><?php echo $i ?></li>
            <?php endif ?>
        <?php endfor ?>
    </ul>
    <?php
        $array1 = [
            "ranieri", // 0
            "allan", // 1
            "ramon", // 2
            "lincoln" // 3
        ];
    ?>
    <ul>
        <?php for ($i = 0; $i < sizeof($array1); $i++): ?>
            <li><?= $array1[$i] ?></li>
            <!-- <li><?php echo $array1[$i] ?></li> -->
        <?php endfor ?>
    </ul>
    <?php
        $array1 = array(
            "ranieri", // 0
            "allan", // 1
            "ramon", // 2
            "lincoln" // 3
        );
    ?>
    <ul>
        <?php foreach($array1 as $professor): ?>
            <li><?= $professor ?></li>
        <?php endforeach ?>
    </ul>
    <?php
        $cachorros = [
            "Pituca" => 1,
            "Toffee" => 4,
            "Turing" => 6,
            "Dandita" => 2
        ];
    ?>
    <ul>
        <?php foreach($cachorros as $nome => $idade): ?>
            <li><?= $nome ?> [<?= $idade ?> ano(s)]</li>
        <?php endforeach ?>
    </ul>
</body>
</html>
