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

	<table class="cart-table">
        <thead>
            <tr>
                <th><?= FILENAME ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
            while ($cart_item = $cart_data->fetch_assoc()) {
?>
                <tr>
                    <td><?= $cart_item['filename'] ?></td>
                    <td class="button_td download" ><a href="?page=download_file&file_id=<?= $cart_item['id_media_file'] ?>" class="button_a download" target="_blank"><?= DOWNLOAD ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>


<?php

require_once('ClientBundle/views/layout/footer.php');

?>
