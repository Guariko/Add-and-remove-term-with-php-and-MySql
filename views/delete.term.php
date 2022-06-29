<?php

$term = $_GET["term"];

$model = "Delete $term ";
$modelStyles = "../css/styles.css";

require_once("../configs/database.php");
require_once("../configs/classes.php");

include("body_head/head.view.php");

Table::initialize(new TableData(DATABASE, $userName, $password));

$termExist = Table::termExists($term, TABLE_NAME);

?>

<main class="delete__main">

    <?php if ($termExist) : ?>
        <h1>Are you sure you want to delete <mark><?= $term ?></mark></h1>
        <form action="" method="POST">
            <div>
                <button name="yes" type="submit">yes</button>

                <button name="no" type="submit">no</button>
            </div>
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["yes"])) {
                Table::deleteTerm($term, TABLE_NAME);
                header("location: layout.view.php");
            } else {
                header("location: layout.view.php");
            };
        };

        ?>
    <?php endif;

    if (!$termExist) : ?>

        <h1><mark><?= $term ?></mark> term doesn't exist</h1>

        <a href="layout.view.php" class="go__home">go home</a>

    <?php endif; ?>
</main>

<?php

include("body_head/body.view.php");
