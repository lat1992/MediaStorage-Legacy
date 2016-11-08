<div id="download_link_div">

    <h2 class="content_subtitle"><?= ACTION ?></h2>

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
<?php
                if (isset($_SESSION['permits'][PERMIT_DOWNLOAD_CONTENT])) {
?>
                    <th></th>
<?php
                }
?>
                <!-- <th><?= ACTION ?></th> -->
            </tr>
        </thead>
        <tbody>
<?php
            if (count($media_files)) {

                foreach ($media_files as $media_file) {
?>
                    <tr>
                        <td><?= $media_file['filename'] ?></td>
                        <td><?= $media_file['type'] ?></td>
<?php
                        if (isset($_SESSION['permits'][PERMIT_DOWNLOAD_CONTENT])) {
?>

                            <td class="td-link" style="padding: 0"><?= '<a class="td-link-button button-add" style="margin: 0" href="?page=add_cart&media_file_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOCART . '</a>' ?></td>
<?php
                        }
?>

                        <?php /*<td style="padding: 0"><?= ($media_file['right_addtocart']) ? '<a class="add_action" href="#temp">' . ADDTOCART . '</a>' : '' ?></td> */ ?>
                        <!-- <td style="padding: 0"><?= '<a class="add_action" href="?page=add_sharelist_media&media_file_id=' . $media_file['id'] . '&original_id='. $_GET['media_id'] . '">' . ADDTOSHARELIST . '</a>' ?></td> -->
                    </tr>
<?php
                }
            }
            else {
?>
                <tr>
                    <td colspan="4" class="text-center"><?= NO_DATA_AVAILABLE ?></td>
                </tr>
<?php
            }
?>
        </tbody>
    </table>
</div>

<div class="clear"></div>