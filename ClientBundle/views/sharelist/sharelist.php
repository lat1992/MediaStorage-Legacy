<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

<div class="container">

    <div class="add">
        <a href="?page=create_sharelist"><?= SHARELIST_CREATION_TITLE ?></a>
    </div>

    <table>
        <thead>
            <tr>
                <th><?= REFERENCE ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php
            while ($sharelist_item = $sharelist_data['data']->fetch_assoc()) {
?>
                <tr>
                    <td><a href="?page=sharelist_edit&sharelist_id=<?= $sharelist_item['id'] ?>"><?= $sharelist_item['reference'] ?></a></td>
                    <td class="button_td delete" ><a href="?page=delete_sharelist&sharelist_id=<?= $sharelist_item['id'] ?>" class="button_a delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
