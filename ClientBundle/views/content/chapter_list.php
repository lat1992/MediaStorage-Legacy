<?php

	$nb_lines = 0;
?>
<div id="chapter_div">

	<h2 class="content_subtitle"><?= CHAPTER ?></h2>

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<div id="chapter_create">
			<label class="label label-chapter"><?= NAME ?></label> : <input type="text" name="data_mediastorage" class="input-line-height">
			<div class="clear"></div>
			<a href="#" id="tc_in_button" class="button button-chapter"><label><?= TC_IN ?></label></a> : <input id="tc_in_input" type="text" class="input-line-height" name="tc_in_mediastorage" readonly />
			<div class="clear"></div>
			<a href="#" id="tc_out_button" class="button button-chapter"><label><?= TC_OUT ?></label></a> : <input id="tc_out_input" class="input-line-height" type="text" name="tc_out_mediastorage" readonly />
			<div class="clear"></div>

		</div>

		<input type="hidden" name="id_media_mediastorage" value="<?= $_GET['media_id'] ?>" />
		<input type="hidden" name="chapter_create" value="5437" />
		<button type="submit" class="button button-validate" class="submit"><?= VALIDATE ?></button>

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
                        <td data-id="<?= $chapter['id'] ?>" class="td-link"><a href="#"  class="chapter_link td-link-button chapter-button"><?= $chapter['data'] ?></a></td>
                        <td class="tc_in"><?= $chapter['tc_in'] ?></td>
                        <td class="tc_out"><?= $chapter['tc_out'] ?></td>
                        <td data-id="<?= $chapter['id'] ?>" class="td-link" ><a class="td-link-button delete-button" href="?page=delete_chapter&media_id=<?= $_GET['media_id'] ?>&chapter_id=<?= $chapter['id'] ?>" ><?= DELETE ?></a></td>
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
