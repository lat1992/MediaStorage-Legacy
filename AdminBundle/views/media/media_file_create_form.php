
		<label for="type_mediastorage"><?= TYPE ?></label>
		<select name="type_mediastorage" id="type_mediastorage"/>
<?php
		foreach ($enums as $enum) {
			echo '<option value="' . $enum . '" ' . (strcmp($enum, $media['type']) == 0 ? ' selected' : '') . '>' . $enum . '</option>';
		}
?>
		</select>
		<div class="clear"></div>

		<label for="filename_mediastorage"><?= FILENAME ?> : </label>
		<input type="text" name="filename_mediastorage" id="filename_mediastorage" value="<?= (isset($media['filename'])) ? $media['filename'] : '' ?>" /><br />
		<div class="clear"></div>

		<label for="filepath_mediastorage"><?= FILEPATH ?> : </label>
		<input type="text" name="filepath_mediastorage" id="filepath_mediastorage" value="<?= (isset($media['filepath'])) ? $media['filepath'] : '' ?>" /><br />
		<div class="clear"></div>

		<input type="hidden" name="right_download_mediastorage" value="0" />
		<label for="right_download_mediastorage"><?= RIGHT_DOWNLOAD ?> : </label>
		<input type="checkbox" class="input_checkbox" name="right_download_mediastorage" id="right_download_mediastorage" value="1" <?= (isset($media['right_download']) && intval($media['right_download']) == 0) ? '' : 'checked' ?> /><br />
		<div class="clear"></div>

		<input type="hidden" name="right_addtocart_mediastorage" value="0" />
		<label for="right_addtocart_mediastorage"><?= RIGHT_ADDTOCART ?> : </label>
		<input type="checkbox" class="input_checkbox" name="right_addtocart_mediastorage" id="right_addtocart_mediastorage" value="1" <?= (isset($media['right_addtocart']) && intval($media['right_addtocart']) == 0) ? '' : 'checked' ?> /><br />
		<div class="clear"></div>

