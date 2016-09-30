<div>
	<table class="cart-table">
        <thead>
            <tr>
                <th><?= OVERVIEW ?></th>
                <th><?= FILENAME ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
            while ($cart_item = $cart_data['data']->fetch_assoc()) {
?>
                <tr>
                    <td><img src="<?= (isset($cart_data['iconpath']) ? $cart_data['iconpath'] : 'uploads/files/'. $_SESSION['id_organization'] .'/icon/default.png') ?>" height="100" width="100"></td>
                    <td><?= $cart_item['filename'] ?></td>
                    <td>
                    <?= (!strcmp($cart_item['type'], 'Download') ? DOWNLOAD : '').
                        (!strcmp($cart_item['type'], 'Delivery') ? DELIVERY : '').
                        (!strcmp($cart_item['type'], 'Transcode') ? TRANSCODE : '').
                        (!strcmp($cart_item['type'], 'Cut') ? CUT : '').
                        (isset($cart_item['tc_in']) && isset($cart_item['tc_out']) ? '<br/> '. TIMECODE_IN . ' : ' . $cart_item['tc_in'] .'<br/>'. TIMECODE_OUT . ' : ' . $cart_item['tc_out'] : '') ?>
                    </td>
                    <td class="button_td delete" ><a href="?page=delete_cart&cart_id=<?= $cart_item['id'] ?>" class="button_a delete"><?= DELETE ?></a></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>