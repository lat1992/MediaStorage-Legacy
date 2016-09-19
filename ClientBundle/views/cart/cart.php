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

    <table>
        <thead>
            <tr>
                <th><?= FILENAME ?></th>
                <th><?= TITLE ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php
            while ($cart_item = $cart_data['data']->fetch_assoc()) {
?>
                <tr>
                    <td><?= $cart_item['filename'] ?></td>
                    <td><a href="?page=content&media_id=<?= $cart_item['id_media'] ?>"><?= $cart_item['translate'] ?></a></td>
                    <td class="button_td delete" ><a href="?page=delete_cart&cart_id=<?= $cart_item['id'] ?>" class="button_a delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
