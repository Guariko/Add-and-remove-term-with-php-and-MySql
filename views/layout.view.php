<?php

$model = "Home";
$modelStyles = "../css/styles.css";

require_once("../configs/database.php");


require_once("../configs/classes.php");

include("body_head/head.view.php");

Table::initialize(new TableData(DATABASE, $userName, $password));

?>

<main class="main">
    <div class="add__search">
        <div>

            <a href="create.term.php">add term</a>
        </div>
        <form action="" method="GET">
            <input type="text" maxlength="50" placeholder="search here" name="searchingFor">
            <button type="submit" name="search"> <i class="fas fa-search"></i> </button>
        </form>

        <?php

        if (isset($_GET["search"])) {

            $searchingFor = $_GET["searchingFor"];
            if (strlen($searchingFor) === 0) {
                $data = Table::getAll("test");
            } else {

                $data = Table::search($searchingFor, TABLE_NAME);
            }
        } else {
            $data = Table::getAll("test");
        };

        ?>
    </div>

    <?php include("table.view.php");

    ?>

</main>

<?php

include("body_head/body.view.php");
