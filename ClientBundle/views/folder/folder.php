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
    if (isset($folders)) {

        if (isset($folders['data']->num_rows) && intval($folders['data']->num_rows) != 0) {
?>
            <span class="category_title category_title_folder"><?= FOLDER ?></span>
<?php
        }
        while ($folder = $folders['data']->fetch_assoc()) {
?>
            <a class="link_div_folder" href="?page=folder&parent_id=<?= $folder['id']; ?>" >
                <div class="hvr-grow col folder">

                    <div class="folder_title_div">
                        <span class="folder_title_span" ><?= $folder['translate'] ?></span>
                    </div>

                    <div class="folder_image_div">
<?php
                    if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/folders/thumbnail_folder_" . $folder['id'] . ".png")) {
?>
                        <img class="folder_image" id="folder_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/folders/thumbnail_folder_<?= $folder['id'] ?>.png" height=100 width=100/>
<?php
                    }
                    else {
?>
                        <img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/folder/img/default_folder.png" height=100 width=100/>
<?php
                    }
?>
                    </div>

                    <div class="folder_description">
<?php
                        if (isset($folder['translate_description']) && $folder['translate_description']) {
?>
                            <span><?= $folder['translate_description'] ?></span>
<?php
                        }
                        else {
                            echo '<span class="program_description_empty">' . NO_DESCRIPTION_AVAILABLE . '</span>';
                        }
?>
                    </div>
                </div>
            </a>
<?php
        }
    }

    if (isset($programs)) {

        if (isset($programs['data']->num_rows) && intval($programs['data']->num_rows) != 0) {
?>
            <span class="category_title category_title_program" ><?= PROGRAM ?></span>
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
                        <img class="program_image" src="ClientBundle/ressources/program/img/default_program.png" />
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
        if (count($contents)) {
?>
            <span class="category_title category_title_content" ><?= CONTENT ?></span>
<?php
        }
        foreach ($contents as $content) {
?>
            <a class="link_div_content" href="?page=content&media_id=<?= $content['id']; ?>" >
                <div class="hvr-grow col content">

                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['translate'] ?></span>
                    </div>

                    <div class="content_image_div">
                        <!-- <img src="ClientBundle/ressources/content/img/default.png" /> -->
                        <img class="content_image" src="ClientBundle/ressources/content/img/default_content.png" />
                    </div>

                    <div class="content_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $content['reference_client'] ?></span><br />
<?php
                        if (isset($content['subtitle_translate']) && $content['subtitle_translate']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $content['subtitle_translate'] ?></span><br />
<?php
                        }
                        foreach ($content['extra'] as $extra) {
?>
                            <span class="description_label"><?= $extra['key'] ?> : </span><span><?= $extra['value'] ?></span><br />
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
