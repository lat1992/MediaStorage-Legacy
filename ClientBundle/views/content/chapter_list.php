<?php

	$nb_lines = 0;
?>
<div id="chapter_div">

	<h2 class="content_subtitle"><?= CHAPTER ?></h2>

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<div id="chapter_create">
			<label class="label"><?= NAME ?> : </label><input type="text" name="data_mediastorage">
			<div class="clear"></div>
			<a href="#" id="tc_in_button"><label><?= TC_IN ?></label></a> : <input id="tc_in_input" type="text" name="tc_in_mediastorage" readonly />
			<div class="clear"></div>
			<a href="#" id="tc_out_button"><label><?= TC_OUT ?></label></a> : <input id="tc_out_input" type="text" name="tc_out_mediastorage" readonly />
			<div class="clear"></div>

		</div>

		<input type="hidden" name="id_media_mediastorage" value="<?= $_GET['media_id'] ?>" />
		<input type="hidden" name="chapter_create" value="5437" />
		<button type="submit" class="submit"><?= VALIDATE ?></button>

	</form>

    <table id="chapter_table">
        <thead>
            <tr>
                <th><?= NAME ?></th>
                <th><?= TC_IN ?></th>
                <th><?= TC_OUT ?></th>
                <th><?= ACTION ?></th>
            </tr>
        </thead>
        <tbody>
<?php
            if (count($chapters)) {

                foreach ($chapters as $chapter) {
?>
                    <tr>
                        <td data-id="<?= $chapter['id'] ?>" ><a href="#" class="chapter_link"><?= $chapter['data'] ?></a></td>
                        <td class="tc_in"><?= $chapter['tc_in'] ?></td>
                        <td class="tc_out"><?= $chapter['tc_out'] ?></td>
                        <td data-id="<?= $chapter['id'] ?>" ><a href="#" ><?= DELETE ?></a></td>
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
