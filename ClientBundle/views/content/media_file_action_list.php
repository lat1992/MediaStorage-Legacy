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
                    <td><?= ($media_file['right_addtocart']) ? '<a href="#">' . ADDTOCART . '</a>' : '' ?></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>

<div class="clear"></div>