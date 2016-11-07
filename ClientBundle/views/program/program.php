<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">
<link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">
<link rel="stylesheet" href="ClientBundle/ressources/program/css/program.css">

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

<?php
if (isset($_GET['media_id'])) {
?>
<div class="program_info">

    <div class="program_info_image_div">
<?php
    if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/programs/thumbnail_program_" . $_GET['media_id'] . ".png")) {
?>
        <img class="program_info_image" id="program_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/programs/thumbnail_program_<?= $_GET['media_id'] ?>.png" height=100 width=100/>
<?php
    }
    else {
?>
        <img class="program_info_image" id="program_image_preview" src="ClientBundle/ressources/program/img/default_program.png" height=100 width=100/>
<?php
    }
?>
    </div>

    <?php require_once('ClientBundle/views/content/media_info_description_list.php'); ?>
    <div class="clear"></div>

</div>
<?php
}
?>

<div class="container">

<?php
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
<?php
                    if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/programs/thumbnail_program_" . $program['id'] . ".png")) {
?>
                        <img class="program_image" id="program_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/programs/thumbnail_program_<?= $program['id'] ?>.png" height=100 width=100/>
<?php
                    }
                    else {
?>
                        <img class="program_image" id="program_image_preview" src="ClientBundle/ressources/program/img/default_program.png" height=100 width=100/>
<?php
                    }
?>
                    </div>

                    <div class="program_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $program['reference_client'] ?></span><br />
<?php
                        if (isset($program['subtitle_translate']) && $program['subtitle_translate']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $program['subtitle_translate'] ?></span><br />
<?php
                        }

                        // @TODO: REFACTO EN MANAGER

                        $media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($program['id']);
                        $media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
                        $media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);
                        $this->mergeErrorArray($media_extra_data);

                        foreach ($media_extra as $id_info_field => $value) {
                            if (strcmp($value['type'], 'Text') == 0) {

                                $user_value = "";
                                if (isset($media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data']))
                                    $user_value = $media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data'];
?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
                                <label></label>
                                <div class="clear"></div>
<?php

                            }
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
        foreach($contents as $content) {
?>
            <a class="link_div_content" href="?page=content&media_id=<?= $content['id']; ?>" >
                <div class="hvr-grow col content">

                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['translate'] ?></span>
                    </div>

                    <div class="content_image_div">
<?php
                    if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/contents/thumbnail_content_" . $content['id'] . ".png")) {
?>
                        <img class="content_image" id="content_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/contents/thumbnail_content_<?= $content['id'] ?>.png" height=100 width=100/>
<?php
                    }
                    else {
?>
                        <img class="content_image" id="content_image_preview" src="ClientBundle/ressources/content/img/default_content.png" height=100 width=100/>
<?php
                    }
?>
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

<div class="view-page-paging">
    <?php require_once('AdminBundle/views/layout/paging.php'); ?>
</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
