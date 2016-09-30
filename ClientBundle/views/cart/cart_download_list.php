<div>
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
                    <td class="button_td download" ><a href="?page=download_file&file_id=<?= $cart_item['id_media_file'] ?>" class="button_a download"><?= DOWNLOAD ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>