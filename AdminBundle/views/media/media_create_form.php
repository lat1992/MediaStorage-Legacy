		<!-- PARENT -->

<?php
		if (isset($parents)) {
?>
			<label for="id_parent_mediastorage"><?= PROGRAM ?></label>
			<select name="id_parent_mediastorage[]" id="id_parent_mediastorage" class="parent_mediastorage">
				<option value=""></option>
<?php


				while ($parent = $parents['data']->fetch_assoc()) {
					$selected = "";
					if (isset($media)) {
						if (intval($parent['id']) == intval($media['id_parent']))
							$selected = "selected";
					}

					echo '<option value="' . $parent['id'] . '" ' . $selected . '>' . $parent['reference_client'] . '</option>';
				}
?>
			</select>
			<div class="clear"></div>

<?php
		}
?>

		<!-- FOLDER PARENT -->

<?php
		// Drawing tree of folders for parent folder selection
		if (isset($parent_folder_data) && count($parent_folder_data) > 0) {
			foreach ($parent_folder_data as $pos => $select) {

				if ($pos == 0) {
?>
					<label for="id_folder_mediastorage"><?= PARENT_FOLDER ?></label>
<?php
				}
				else {
?>
					<div class="clear" class="folder_mediastorage_clear"></div>
					<label for="id_folder_mediastorage" class="folder_mediastorage_label"></label>
<?php
				}
?>
				<select name="id_folder_mediastorage[]" id="id_folder_mediastorage" class="folder_mediastorage">
<?php
					foreach ($select['folders'] as $key => $option) {
						// In order to have the first emmpty select
						if ($key == 0) {
?>
							<option value=""></option>
<?php
						}

						// In order to pre-select the value of the selects, based on the parent if of the current folder and the id of all the folders
						$selected = (strcmp($select['data']['id'], $option['id']) == 0) ? 'selected' : '';
?>
						<option value="<?= $option['id'] ?>" <?= $selected ?> ><?= $option['translate'] ?></option>
<?php
					}
?>
				</select>
<?php
			}
		}
		else {
			// Drawing the base empty tree
?>
			<label for="id_folder_mediastorage"><?= PARENT_FOLDER ?></label>
			<select name="id_folder_mediastorage[]" id="id_folder_mediastorage" class="folder_mediastorage">
				<option value=""></option>
<?php
				while ($folder = $folders['data']->fetch_assoc()) {
					if (intval($folder['id']) != intval($_GET['folder_id'])) {
						echo '<option value="' . $folder['id'] . '" >' . $folder['translate'] . '</option>';
					}
				}
?>
			</select>
<?php
		}
?>
		<div class="clear"></div>

		<!-- REFERENCE -->

<?php
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

		<input type="hidden" name="right_view_mediastorage" value="0" />
		<label for="right_view_mediastorage"><?= RIGHT_VIEW ?> : </label>
		<input type="checkbox" class="input_checkbox" name="right_view_mediastorage" id="right_view_mediastorage" value="1" <?= (isset($media['right_view']) && intval($media['right_view']) == 0) ? '' : 'checked' ?> /><br />
		<div class="clear"></div>

<?php
			if (isset($_GET['media_id'])) {
?>
				<label for="tumbnail_mediastorage" ><?= MORE_OPTION ?> : </label>
				<div class="div_more_info"><a class="button button-more-options" id="more_info_show" href="#">+</a><a class="button button-more-options" id="more_info_hide" href="#">-</a></div>
			    <div class="clear"></div>


		        <div id="more_info_data">

					<label for="tumbnail_mediastorage" style="margin: 10px 5px 10px 0" ><?= THUMBNAIL ?> : </label>
<?php
					require_once('AdminBundle/views/folder/thumbnail_upload_form.php');
?>
			        <label><?= PREVIEW ?> : </label>
			        <div class="<?= $type ?>_image_div" style="display: inline-block;float: left; margin: 10px">
			            <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
<?php
					if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/" . $type . "s/thumbnail_" . $type . "_" . $_GET['media_id'] . ".png")) {
?>
			            <img class="<?= $type ?>_image" id="<?= $type ?>_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/<?= $type ?>s/thumbnail_<?= $type ?>_<?= $_GET['media_id'] ?>.png" height=100 width=100/>

				        <div class="clear"></div>
			            <a class="button button-delete" href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=<?= $_GET['media_id'] ?>" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
<?php
					}
					else {
						if (strcmp($type, 'program') == 0) {
?>
							<img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/program/img/default_program.png" height=100 width=100 />
<?php
						}
						else {
?>
							<img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/content/img/default_content.png" height=100 width=100 />
<?php
						}
?>

				        <div class="clear"></div>
			            <a class="button button-delete" href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=<?= $_GET['media_id'] ?>" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
<?php
					}
?>
			        </div>
			        <div class="clear"></div>
			    </div>

<?php
			}
?>
	        <div id="more_info_data">

				<label for="tumbnail_mediastorage" style="margin: 10px 5px 10px 0" ><?= THUMBNAIL ?> : </label>
	<?php
				require_once('AdminBundle/views/folder/thumbnail_upload_form.php');
	?>
		        <label><?= PREVIEW ?> : </label>
		        <div class="<?= $type ?>_image_div" style="display: inline-block;float: left; margin: 10px">
		            <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
	<?php
				if (file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/" . $type . "s/thumbnail_" . $type . "_" . $_GET['media_id'] . ".png")) {
	?>
		            <img class="<?= $type ?>_image" id="<?= $type ?>_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/<?= $type ?>s/thumbnail_<?= $type ?>_<?= $_GET['media_id'] ?>.png" height=100 width=100/>

			        <div class="clear"></div>
		            <a class="button button-delete" href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=<?= $_GET['media_id'] ?>" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
	<?php
				}
				else {
						if (strcmp($type, 'program') == 0) {
?>
							<img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/program/img/default_program.png" height=100 width=100 />
<?php
						}
						else {
?>
							<img class="folder_image" id="folder_image_preview" src="ClientBundle/ressources/content/img/default_content.png" height=100 width=100 />
<?php
						}
?>
			        <div class="clear"></div>
		            <a class="button button-delete" href="<?= $_SERVER['REQUEST_URI'] ?>&delete_image=<?= $_GET['media_id'] ?>" style="display: inline-block;margin-top: 5px"><?= DELETE ?></a>
	<?php
				}
	?>
		        </div>
		        <div class="clear"></div>
		    </div>
<?php
		// }
?>

