<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">

<script src="ClientBundle/ressources/folder/js/folder.js"></script>

<div class="container">

<?php
    if (isset($programs)) {
        while ($program = $programs['data']->fetch_assoc()) {
?>
            <a class="link_div_program" href="?page=program&media_id=<?= $program['id']; ?>">
            <div class="col hvr-grow program">
                <div class="title_div"><span><h2><?= $program['reference'] ?></h2></span></div>
                <img src="ClientBundle/ressources/media/img/default-program.png" />
                <div>
                <!-- TODO: DESCIPTION OF PROGRAMME HERE -->
                </div>

                <div class="clear_div"></div>
            </div>
            </a>
<?php
        }
    }

    if (isset($contents)) {
        while ($content = $contents['data']->fetch_assoc()) {

            if (isset($_SESSION['permits'][PERMIT_VIEW_CONTENT])) {
?>
                <a class="link_div_content" href="?page=content&media_id=<?= $content['id']; ?>">
<?php
            }
?>
            <div class="col hvr-grow content">
                <div class="title_div"><span><h2><?= $content['reference'] ?></h2></span></div>
                <img src="ClientBundle/ressources/media/img/default-content.png" />
                <div>
                <!-- TODO: DESCIPTION OF CONTENT HERE -->
                </div>

                <div class="clear_div"></div>
            </div>
            </a>
<?php
        }
    }
?>
<?php

require_once('ClientBundle/views/layout/footer.php');

?>
