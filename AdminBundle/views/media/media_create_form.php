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
			<input type="hidden" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($media['reference'])) ? $media['reference'] : '' ?>" />
			<input disabled type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($media['reference'])) ? $media['reference'] : '' ?>" /><br />
<?php
		}
?>
		<label for="reference_client_mediastorage"><?= REFERENCE_CLIENT ?> : </label>
		<input type="text" name="reference_client_mediastorage" id="reference_client_mediastorage" value="<?= (isset($media['reference_client'])) ? $media['reference_client'] : '' ?>" /><br />
		<div class="clear"></div>

		<label for="handover_date_mediastorage"><?= HANDOVER_DATE ?> : </label>
		<input disabled type="text" name="handover_date_mediastorage" id="handover_date_mediastorage ?>" value="<?= (isset($media['handover_date'])) ? $media['handover_date'] : '' ?>" /><br />
		<div class="clear"></div>

		<input type="hidden" name="right_view_mediastorage" value="0" />
		<label for="right_view_mediastorage"><?= RIGHT_VIEW ?> : </label>
		<input type="checkbox" class="input_checkbox" name="right_view_mediastorage" id="right_view_mediastorage" value="1" <?= (isset($media['right_view']) && intval($media['right_view']) == 0) ? '' : 'checked' ?> /><br />
		<div class="clear"></div>

		<label for="tumbnail_mediastorage" style="margin: 10px 5px 10px 0" ><?= THUMBNAIL ?> : </label>

<?php
		$path = "?page=upload_program_thumbnail_admin&media_id=" . $_GET['media_id'];

		require_once('AdminBundle/views/folder/thumbnail_upload_form.php');
?>

        <label><?= PREVIEW ?> : </label>
        <div class="folder_image_div" style="display: inline-block;float: left; margin: 10px">
            <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
<?php
		if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/programs/thumbnail_program_" . $_GET['media_id'] . ".png")) {
?>
            <img class="program_image" id="folder_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/programs/thumbnail_program_<?= $_GET['media_id'] ?>.png" height=100 width=100/>

	        <div class="clear"></div>
            <a href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=1" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
<?php
		}
		else {
?>
			<img class="folder_image" id="folder_image_preview" src="https://www.carmelsaintjoseph.com/wp-content/uploads/2016/08/8.-Ao%C3%BBt-2016-100x100.jpg	" height=100 width=100 />

	        <div class="clear"></div>
            <a href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=1" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
<?php
		}
?>
        </div>
        <div class="clear"></div>
