<?php require_once('ClientBundle/views/layout/header.php'); ?>

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

<div id="container">

	<a class="button button-add" href="?page=create_user_admin"><?= USER_CREATION_TITLE ?></a>

	<?php require_once('AdminBundle/views/common/table_list.php');?>

    <?php require_once('AdminBundle/views/layout/paging.php'); ?>

</div>

<?php require_once('ClientBundle/views/layout/footer.php'); ?>
