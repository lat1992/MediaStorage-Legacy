<?php
		if (isset($parents)) {
?>
			<label for="id_parent_mediastorage"><?= MEDIA_PARENT ?></label>
			<select name="id_parent_mediastorage[]" id="id_parent_mediastorage" class="parent_mediastorage">
				<option value=""></option>
<?php
				while ($parent = $parents['data']->fetch_assoc()) {
					echo '<option value="' . $parent['id'] . '" >' . $parent['reference_client'] . '</option>';
				}
?>
			</select>
			<div class="clear"></div>

<?php
			if (isset($_GET['media_id']))  {
?>
				<label></label>
				<span class="info_multiple_select"><?= INFO_MOVE_DIRECTORY ?></span>
				<div class="clear"></div>
<?php
			}
		}
?>
		<label for="id_folder_mediastorage"><?= FOLDER_PARENT ?></label>
		<select name="id_folder_mediastorage[]" id="id_folder_mediastorage" class="folder_mediastorage">
			<option value=""></option>
<?php
			while ($folder = $folders['data']->fetch_assoc()) {
				echo '<option value="' . $folder['id'] . '" >' . $folder['translate'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>

<?php
		if (isset($_GET['media_id']))  {
?>
			<label></label>
			<span class="info_multiple_select"><?= INFO_MOVE_DIRECTORY ?></span>
			<div class="clear"></div>
<?php
		}

		if (isset($_GET['media_id']))  {
?>
			<label for="reference_mediastorage"><?= REFERENCE ?> : </label>
			<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($media['reference'])) ? $media['reference'] : '' ?>" /><br />
<?php
		}
?>
		<label for="reference_client_mediastorage"><?= REFERENCE_CLIENT ?> : </label>
		<input type="text" name="reference_client_mediastorage" id="reference_client_mediastorage" value="<?= (isset($media['reference_client'])) ? $media['reference_client'] : '' ?>" /><br />
		<div class="clear"></div>

		<label for="handover_date_mediastorage"><?= HANDOVER_DATE ?> : </label>
		<input type="text" name="handover_date_mediastorage" id="handover_date_mediastorage ?>" value="<?= (isset($media['handover_date'])) ? $media['handover_date'] : '' ?>" /><br />
		<div class="clear"></div>

		<input type="hidden" name="right_view_mediastorage" value="0" />
		<label for="right_view_mediastorage"><?= RIGHT_VIEW ?> : </label>
		<input type="checkbox" class="input_checkbox" name="right_view_mediastorage" id="right_view_mediastorage" value="1" <?= (isset($media['right_view']) && intval($media['right_view']) == 0) ? '' : 'checked' ?> /><br />
		<div class="clear"></div>

