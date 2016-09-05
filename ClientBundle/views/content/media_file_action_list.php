<div id="download_link_div">
    <table id="download_link_table">
        <tbody>
<?php
            foreach ($media_files as $media_file) {
?>
                <tr>
                    <td><?= $media_file['filename'] ?></td>
                    <td><?= $media_file['type'] ?></td>
                    <td><?= ($media_file['right_download']) ? '<a href="#">' . DOWNLOAD . '</a>' : '' ?></td>
                    <td><?= ($media_file['right_addtocart']) ? '<a href="?page=add_cart&media_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOCART . '</a>' : '' ?></td>
                    <td><?= ($media_file['right_addtocart']) ? '<a href="?page=add_sharelist_media&media_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOSHARELIST . '</a>' : '' ?></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>

<div class="clear"></div>