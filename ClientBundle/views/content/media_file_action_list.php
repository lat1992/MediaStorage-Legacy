<div id="download_link_div">

    <div id="temp" style="width: 50%; height: 50%; position: absolute;top:0;bottom: 0;left: 0;right: 0;margin: auto;display: none; background-color: white">
        <span>Livraison</span>
        <form>
            <label><?= USAGE ?></label>
            <select name="usage_select" id="usage_select">
                <option value="1"><?= SOURCE_FILE ?></option>
                <option value="2"><?= WATCHING_FILE ?></option>
                <option value="3"><?= CUT_FILE ?></option>
                <option value="4"><?= TRANSCODAGE ?></option>
            </select>
            <div id="dynamic_form">

            </div>
        </form>
    </div>

    <table id="download_link_table">
        <thead>
            <tr>
                <th><?= FILENAME ?></th>
                <th><?= TYPE ?></th>
                <th><?= ACTION ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
            foreach ($media_files as $media_file) {
?>
                <tr>
                    <td><?= $media_file['filename'] ?></td>
                    <td><?= $media_file['type'] ?></td>
                    <td style="padding: 0"><?= ($media_file['right_addtocart']) ? '<a class="add_action" href="?page=add_cart&media_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOCART . '</a>' : '' ?></td>
                    <?php /*<td style="padding: 0"><?= ($media_file['right_addtocart']) ? '<a class="add_action" href="#temp">' . ADDTOCART . '</a>' : '' ?></td> */ ?>
                    <td style="padding: 0"><?= ($media_file['right_addtocart']) ? '<a class="add_action" href="?page=add_sharelist_media&media_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOSHARELIST . '</a>' : '' ?></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>

<div class="clear"></div>