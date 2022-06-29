<?php

if (!isset($data)) {
    die();
};


$normalizeToArray = 2;
$returnIndexToZero = 1;

if (!isset($tableClass)) {
    $tableClass = "table";
}


?>

<table class="<?= $tableClass ?>">

    <tr>
        <th colspan="<?= (count($data[0]) / $normalizeToArray) - $returnIndexToZero ?>">Your terms</th>
    </tr>

    <?php foreach ($data as $key => $value) : ?>

        <tr>

            <?php for ($i = 1; $i < (count($value) / $normalizeToArray); $i++) : ?>

                <td>
                    <?= $value[$i] ?>
                </td>
            <?php endfor; ?>
            <td><a href="delete.term.php?term=<?= $value["term"] ?>" class="delete">delete</a></td>
        </tr>

    <?php endforeach; ?>
</table>