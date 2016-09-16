<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">

<script src="ClientBundle/ressources/folder/js/folder.js"></script>

<style>

<?php
    if (isset($designs)) {

        foreach ($designs as $design) {
?>
            <?= $design['selector'] ?> {
                <?= $design['property'] ?> : <?= $design['value'] ?>;
            }
<?php
        }
    }
?>

</style>

<div class="container">

<?php
    if (isset($programs)) {

        if (isset($programs['data']->num_rows) && intval($programs['data']->num_rows) != 0) {
?>
            <span class="category_title" ><?= PROGRAM ?></span>
<?php
        }
        while ($program = $programs['data']->fetch_assoc()) {
?>
            <a class="link_div_program" href="?page=program&media_id=<?= $program['id']; ?>" >
                <div class="hvr-grow col program">

                    <div class="program_title_div">
                        <span class="program_title_span" ><?= $program['translate'] ?></span>
                    </div>

                    <div class="program_image_div">
                        <!-- <img src="ClientBundle/ressources/program/img/default.png" /> -->
                        <img class="program_image" src="https://www.carmelsaintjoseph.com/wp-content/uploads/2016/08/8.-Ao%C3%BBt-2016-100x100.jpg" />
                    </div>

                    <div class="program_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $program['reference_client'] ?></span><br />
<?php
                        if (isset($program['subtitle_translate']) && $program['subtitle_translate']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $program['subtitle_translate'] ?></span>
<?php
                        }
?>
                    </div>


                </div>
            </a>
<?php
        }
    }


    if (isset($contents)) {

        if (isset($contents['data']->num_rows) && intval($contents['data']->num_rows) != 0) {
?>
            <span class="category_title" ><?= CONTENT ?></span>
<?php
        }
        while ($content = $contents['data']->fetch_assoc()) {
?>
            <a class="link_div_content" href="?page=content&media_id=<?= $content['id']; ?>" >
                <div class="hvr-grow col content">

                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['translate'] ?></span>
                    </div>

                    <div class="content_image_div">
                        <!-- <img src="ClientBundle/ressources/content/img/default.png" /> -->
                        <img class="content_image" src="https://www.carmelsaintjoseph.com/wp-content/uploads/2016/08/8.-Ao%C3%BBt-2016-100x100.jpg" />
                    </div>

                    <div class="content_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $content['reference_client'] ?></span><br />
<?php
                        if (isset($content['description']) && $content['description']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $content['subtitle_translate'] ?></span>
<?php
                        }
?>
                    </div>


                </div>
            </a>
 <?php
        }
    }
?>
<?php

require_once('ClientBundle/views/layout/footer.php');

?>
