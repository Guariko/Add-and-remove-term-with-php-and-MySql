<?php

$model = "Create Term";
$modelStyles = "../css/styles.css";

require_once("../configs/database.php");

require_once("../configs/classes.php");

include("body_head/head.view.php");

Table::initialize(new TableData(DATABASE, $userName, $password));

$termMaxLenght = 16;
$contentMaxLength = 50;

?>

<main class="create__term__main">

    <form action="" method="POST">

        <div>
            <label for="term">term</label>
            <input type="text" name="term" id="term" required minlength="1" maxlength="16">

        </div>

        <div>
            <label for="content">content</label>
            <textarea name="content" id="content" cols="30" rows="10" required minlength="1" maxlength="50"></textarea>
        </div>
        <div>
            <button type="reset">clear</button>
            <button type="submit">create term</button>
        </div>
    </form>

    <a href="layout.view.php" class="go__home">go home</a>

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $term = $_POST["term"];
        $content = $_POST["content"];

        if (strlen($term) <= $termMaxLenght &&  strlen($content) <= $contentMaxLength) {
            Table::insertData(TABLE_NAME, $term, $content);
            unset($term);
            unset($content);
            header("location: layout.view.php");
            die();
        };
    };

    ?>

</main>

<?php

include("body_head/body.view.php");
