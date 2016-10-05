<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

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
    if (isset($text['general_condition'])) {
?>
        <div class="page-text">
        <?= $text['general_condition'] ?>
        </div>
<?php
    }
?>

    <div class="validate_cart">
        <a id="validate_button" class="form_button" href="javascript:window.open('','_self').close();"><?= CLOSE ?></a>
    </div>
<?php

require_once('ClientBundle/views/layout/footer.php');

?>
