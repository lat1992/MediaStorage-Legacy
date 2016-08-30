<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

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
                    <td><a href="?content&media_id=<?= $cart_item['id_media'] ?>"><?= $cart_item['translate'] ?></a></td>
                    <td class="button_td delete" ><a href="#" class="button_a delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
