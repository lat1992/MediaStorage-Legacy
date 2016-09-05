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
            while ($sharelist_item = $sharelist_media_data['data']->fetch_assoc()) {
?>
                <tr>
                    <td><?= $sharelist_item['filename'] ?></td>
                    <td><a href="?page=sharelist_edit&sharelist_id=<?= $sharelist_item['id'] ?>"><?= $sharelist_item['translate'] ?></a></td>
                    <td class="button_td delete" ><a href="?page=delete_sharelist_media&sharelist_media_id=<?= $sharelist_item['id'] ?>&sharelist_id=<?= $sharelist_item['id_sharelist'] ?>" class="button_a delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
