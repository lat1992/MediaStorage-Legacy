<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

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

    <table class="cart-table">
        <thead>
            <tr>
                <th><?= OVERVIEW ?></th>
                <th><?= FILENAME ?></th>
                <th><?= DESCRIPTIVE ?></th>
                <th><?= USAGE ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
        if ($cart_data['data']->num_rows) {
            while ($cart_item = $cart_data['data']->fetch_assoc()) {
?>
                <tr>
                    <td><img src="<?= (file_exists('uploads/thumbnails/files/'.$_SESSION['id_organization'].'/contents/thumbnail_content_'.$cart_item['id_media'].'.png') ? 'uploads/thumbnails/files/'.$_SESSION['id_organization'].'/contents/thumbnail_content_'.$cart_item['id_media'].'.png' : 'ClientBundle/ressources/content/img/default_content.png') ?>" height="100" width="100"></td>
                    <td><?= $cart_item['filename'] ?></td>
                    <td class="td-descriptive">
                        <?= TITLE ?> : <a href="?page=content&media_id=<?= $cart_item['id_media'] ?>"><?= $cart_item['translate_title'] ?></a><br/>
                        <?= SUBTITLE ?> : <?= $cart_item['translate_subtitle'] ?><br/>
                        <?= DESCRIPTION ?> : <?= $cart_item['translate_description'] ?>
                    </td>
                    <td>
                    <?= (!strcmp($cart_item['type'], 'Download') ? DOWNLOAD : '').
                        (!strcmp($cart_item['type'], 'Delivery') ? DELIVERY : '').
                        (!strcmp($cart_item['type'], 'Transcode') ? TRANSCODE : '').
                        (!strcmp($cart_item['type'], 'Cut') ? CUT : '').
                        (isset($cart_item['tc_in']) && isset($cart_item['tc_out']) ? '<br/> '. TIMECODE_IN . ' : ' . $cart_item['tc_in'] .'<br/>'. TIMECODE_OUT . ' : ' . $cart_item['tc_out'] : '') ?>
                    </td>
                    <td class="td-link" style="padding-right: 5px;" ><a href="?page=delete_cart&cart_id=<?= $cart_item['id'] ?>" style="padding-left: 5px;" class="td-link-button button-delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
        }
        else {
?>
            <tr>
                <td colspan="5" class="text-center"><?= NO_DATA_AVAILABLE ?></td>
            </tr>
<?php
        }
?>
        </tbody>
    </table>
<?php
    if ($cart_data['data']->num_rows) {
?>
        <div  class="validate_form"><?= VALIDATE_THE ?><a href="?page=general_condition" target="_blank"><?= GENERAL_CONDITION ?></a>: <input type="checkbox" id="validate_check" onchange="validate()"></div>
        <div class="validate_cart" id="validate_cart" style="min-height: 150px;">
            <a id="validate_button" class="form_button" href="?page=validate_cart" style="pointer-events: none; cursor: default;"><?= VALIDATE ?></a>
        </div>
        <script>
        function validate() {
            var status = document.getElementById("validate_check").checked;
            if (status == true)
                document.getElementById("validate_cart").innerHTML = '<a id="validate_button" class="form_button" href="?page=validate_cart"><?= VALIDATE ?></a>';
            else
                document.getElementById("validate_cart").innerHTML = '<a id="validate_button" class="form_button" href="?page=validate_cart" style="pointer-events: none; cursor: default;"><?= VALIDATE ?></a>';
        }
        </script>
<?php
    }

    require_once('ClientBundle/views/layout/footer.php');

?>
