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
                <th><?= FILENAME ?></th>
                <th><?= ORDER_DATE ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
            while ($cart_item = $cart_data->fetch_assoc()) {
?>
                <tr>
                    <td style="word-wrap: break-word;white-space: normal;" ><?= $cart_item['filename'] ?></td>
                    <td style="word-wrap: break-word;white-space: normal;" ><?= $cart_item['date'] ?></td>
                    <td class="td-link" ><a href="?page=download_file&token=<?= $cart_item['token'] ?>" class="td-link-button button-add" target="_blank"><?= DOWNLOAD ?></a></td>
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
