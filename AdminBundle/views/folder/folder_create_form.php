<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_parent_mediastorage"><?= PARENT_FOLDER ?></label>
		<select name="id_parent_mediastorage[]" id="id_parent_mediastorage" class="parent_mediastorage">
			<option value=""></option>
<?php
			while ($folder = $folders['data']->fetch_assoc()) {
				echo '<option value="' . $folder['id'] . '" >' . $folder['translate'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>


<?php

		if (isset($_GET['folder_id']))  {
?>
			<label></label>
			<span class="info_multiple_select"><?= INFO_MOVE_DIRECTORY ?></span>
			<div class="clear"></div>
<?php
?>
			<label for="tumbnail_mediastorage" ><?= MORE_OPTION ?> : </label>
			<div class="div_more_info">( <a class="info_link" id="more_info_show" href="#">+</a><a class="info_link" id="more_info_hide" href="#">-</a> )</div>
	        <div class="clear"></div>

	        <div id="more_info_data">

				<label for="tumbnail_mediastorage" style="margin: 10px 5px 10px 0" ><?= THUMBNAIL ?> : </label>

	<?php
				$path = "";
				if (isset($_GET['folder_id'])) {
					$path = "?page=upload_thumbnail_admin&folder_id=" . $_GET['folder_id'];
				}
				$type = "folder";

				require_once('AdminBundle/views/folder/thumbnail_upload_form.php');
	?>

		        <label><?= PREVIEW ?> : </label>
		        <div class="folder_image_div" style="display: inline-block;float: left; margin: 10px">
		            <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
	<?php
				if (isset($_GET['folder_id']) && file_exists("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/folders/thumbnail_folder_" . $_GET['folder_id'] . ".png")) {
	?>
		            <img class="folder_image" id="folder_image_preview" src="uploads/thumbnails/files/<?= $_SESSION['id_organization'] ?>/folders/thumbnail_folder_<?= $_GET['folder_id'] ?>.png" height=100 width=100/>

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

		    </div>

<?php
		}

			$cpt = 0;
			foreach($languages as $language) {
?>
				<label for="data_mediastorage_<?= $cpt ?>" ><?= LANGUAGE_TRANSLATE . ' ' . $language['name'] . ' / ' . $language['code'] ?> : </label>
				<input type="text" name="data_mediastorage[<?= $language['id'] ?>]" id="data_mediastorage_<?= $cpt ?>" value="<?= (isset($folder_language[intval($language['id'])])) ? $folder_language[intval($language['id'])]['data'] : '' ?>" /><br />
				<div class="clear"></div>
<?php
				$cpt++;
			}
			$cpt = 0;
			foreach($languages as $language) {
?>
				<label for="description_mediastorage_<?= $cpt ?>"><?= DESCRIPTION . ' ' . $language['name'] . ' / ' . $language['code'] ?> : </label>
				<textarea rows="4" cols="50" name="description_mediastorage[<?= $language['id'] ?>]" id="data_mediastorage_<?= $cpt ?>"><?= (isset($folder_language[intval($language['id'])])) ? $folder_language[intval($language['id'])]['description'] : '' ?></textarea>
				<div class="clear"></div>
<?php
				$cpt++;
			}
?>
		<input type="hidden" name="id_folder_create_mediastorage" value="984156" />

		<a id="cancel_button" class="form_button" href="?page=list_folder_admin"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>