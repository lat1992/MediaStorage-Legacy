<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">
<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

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
            <div class="hvr-grow col folder">

                <a href="?page=folder&parent_id=<?= $folder['id']; ?>">
                    <div class="folder_title_div">
                        <span class="folder_title_span" ><?= $folder['translate'] ?></span>
                    </div>
                </a>
                <div class="folder_image_div">
<?php
                if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/folders/thumbnail_folder_" . $folder['id'] . ".png")) {
?>
                    <a href="?page=folder&parent_id=<?= $folder['id']; ?>">
                        <img class="folder_image" id="folder_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/folders/thumbnail_folder_<?= $folder['id'] ?>.png" height=100 width=100/>
                    </a>
<?php
                }
                else {
?>
                    <a href="?page=folder&parent_id=<?= $folder['id']; ?>">
                        <img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/folder/img/default_folder.png" height=100 width=100/>
                    </a>
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

<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_folder_admin&folder_id=<?= $folder['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
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
            <div class="hvr-grow col program">

                <a  href="?page=program&media_id=<?= $program['id']; ?>" >
                    <div class="program_title_div">
                        <span class="program_title_span" ><?= $program['translate'] ?></span>
                    </div>
                </a>

                <div class="program_image_div">
                    <!-- <img src="ClientBundle/ressources/program/img/default.png" /> -->
                    <a  href="?page=program&media_id=<?= $program['id']; ?>" >
                        <img class="program_image" src="<?php if (file_exists('uploads/thumbnails/files/'.$_SESSION['id_organization'].'/programs/thumbnail_program_'.$program['id'].'.png')) echo 'uploads/thumbnails/files/'.$_SESSION['id_organization'].'/programs/thumbnail_program_'.$program['id'].'.png'; else echo 'ClientBundle/ressources/program/img/default_program.png'; ?>" />
                    </a>
                </div>

                <div class="program_description">

                    <span class="description_label"><?= REFERENCE ?> : </span><span><?= $program['reference_client'] ?></span><br />
<?php
                    if (isset($program['subtitle_translate']) && $program['subtitle_translate']) {
?>
                        <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $program['subtitle_translate'] ?></span>
<?php
                    }





                    // @TODO: REFACTO EN MANAGER

                    $media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($program['id']);
                    $media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
                    $media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);
                    $this->mergeErrorArray($media_extra_data);

                    foreach ($media_extra as $id_info_field => $value) {

                        if (intval($value['display_in_card']) == 1) {

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

                            elseif (strcmp($value['type'], 'Date') == 0) {

                                $user_value = "";
                                if (isset($media_user_extras[$id_info_field]['data']))
                                    $user_value = $media_user_extras[$id_info_field]['data'];
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Array_multiple') == 0) {
    ?>

                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span>
    <?php
                                    $cpt = 0;
                                    foreach ($value['data'] as $row) {
                                        if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {

                                            $user_value = "";
                                            if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false) {
                                                if ($cpt > 0)
                                                    echo ', ' . $row['element'];
                                                else
                                                    echo $row['element'];
                                                $cpt++;
                                            }
                                        }
                                    }
    ?>
                                </span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Array_unique') == 0) {
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span>

    <?php
                                    foreach ($value['data'] as $row) {
                                        if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {

                                            $user_value = "";

                                            if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array'])) {
                                                echo $row['element'];
                                            }
                                        }
                                    }
    ?>
                                </span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Boolean') == 0) {

                                $user_value = NO;
                                if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
                                    $user_value = YES;
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                        }
                    }
?>










                </div>
<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_program_admin&media_id=<?= $program['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
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
            <div class="hvr-grow col content">

                <a href="?page=content&media_id=<?= $content['id']; ?>" >
                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['translate'] ?></span>
                    </div>
                </a>

                <div class="content_image_div">
                    <!-- <img src="ClientBundle/ressources/content/img/default.png" /> -->
                    <a href="?page=content&media_id=<?= $content['id']; ?>" >
                        <img class="content_image" src="<?php if (file_exists('uploads/thumbnails/files/'.$id_organization.'/contents/thumbnail_content_'.$content['id'].'.png')) echo 'uploads/thumbnails/files/'.$id_organization.'/contents/thumbnail_content_'.$content['id'].'.png'; else echo 'ClientBundle/ressources/content/img/default_content.png';?>" />
                    </a>
                </div>

                <div class="content_description">

                    <span class="description_label"><?= REFERENCE ?> : </span><span><?= $content['reference_client'] ?></span><br />
<?php
                    if (isset($content['subtitle_translate']) && $content['subtitle_translate']) {
?>
                        <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $content['subtitle_translate'] ?></span><br />
<?php
                    }


                    // @TODO: REFACTO EN MANAGER

                    $media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($content['id']);
                    $media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
                    $media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);
                    $this->mergeErrorArray($media_extra_data);

                    foreach ($media_extra_content as $id_info_field => $value) {

                        if (intval($value['display_in_card']) == 1) {

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

                            elseif (strcmp($value['type'], 'Date') == 0) {

                                $user_value = "";
                                if (isset($media_user_extras[$id_info_field]['data']))
                                    $user_value = $media_user_extras[$id_info_field]['data'];
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Array_multiple') == 0) {
    ?>

                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span>
    <?php
                                    $cpt = 0;
                                    foreach ($value['data'] as $row) {
                                        if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {

                                            $user_value = "";
                                            if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false) {
                                                if ($cpt > 0)
                                                    echo ', ' . $row['element'];
                                                else
                                                    echo $row['element'];
                                                $cpt++;
                                            }
                                        }
                                    }
    ?>
                                </span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Array_unique') == 0) {
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span>

    <?php
                                    foreach ($value['data'] as $row) {
                                        if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {

                                            $user_value = "";

                                            if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array'])) {
                                                echo $row['element'];
                                            }
                                        }
                                    }
    ?>
                                </span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                            elseif (strcmp($value['type'], 'Boolean') == 0) {

                                $user_value = NO;
                                if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
                                    $user_value = YES;
    ?>
                                <span class="description_label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
                                <label></label>
                                <div class="clear"></div>
    <?php
                            }
                        }
                    }
?>










                </div>
<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_content_admin&media_id=<?= $content['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
 <?php
        }
    }
?>

<div class="view-page-paging">
    <?php require_once('AdminBundle/views/layout/paging.php'); ?>
</div>

<?php require_once('ClientBundle/views/layout/footer.php'); ?>
