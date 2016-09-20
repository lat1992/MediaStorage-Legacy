<?php
	if ($languages) {

		foreach ($languages as $language) {

			$user_value = '';
			if (isset($media_infos[$language['id']]['title']))
				$user_value = $media_infos[$language['id']]['title'];
?>
			<label for="title_mediastorage_<?= $language['code'] ?>"><?= TITLE . ' - ' . $language['code'] ?> : </label>
			<input type="text" name="title_mediastorage[<?= $language['id'] ?>]" id="title_mediastorage_<?= $language['code'] ?>" value="<?= $user_value ?>" /><br />
			<div class="clear"></div>
<?php
		}
?>
		<label></label>
		<div class="clear"></div>
<?php
		foreach ($languages as $language) {

			$user_value = '';
			if (isset($media_infos[$language['id']]['subtitle']))
				$user_value = $media_infos[$language['id']]['subtitle'];
?>
			<label for="subtitle_mediastorage_<?= $language['code'] ?>"><?= SUBTITLE . ' - ' . $language['code'] ?> : </label>
			<input type="text" name="subtitle_mediastorage[<?= $language['id'] ?>]" id="subtitle_mediastorage_<?= $language['code'] ?>" value="<?= $user_value ?>" /><br />
			<div class="clear"></div>
<?php
		}
?>
		<label></label>
		<div class="clear"></div>
<?php
		foreach ($languages as $language) {

			$user_value = '';
			if (isset($media_infos[$language['id']]['description']))
				$user_value = $media_infos[$language['id']]['description'];
?>
			<label for="description_mediastorage_<?= $language['code'] ?>"><?= DESCRIPTION . ' - ' . $language['code'] ?> : </label>
			<input type="text" name="description_mediastorage[<?= $language['id'] ?>]" id="description_mediastorage_<?= $language['code'] ?>" value="<?= $user_value ?>" /><br />
			<div class="clear"></div>
<?php
		}
?>
		<label></label>
		<div class="clear"></div>

			<?php /*<label for="data_mediastorage_<?= $language['code'] ?>" ><?= LANGUAGE_TRANSLATE . ' ' . $language['name'] . ' / ' . $language['code'] ?> : </label>
			<input type="text" name="data_mediastorage[<?= $language['id'] ?>]" id="data_mediastorage_<?= $language['code'] ?>" value="<?= (isset($folder_language[intval($language['id'])])) ? $folder_language[intval($language['id'])]['data'] : '' ?>" /><br />
			<div class="clear"></div> */ ?>
<?php

			require('AdminBundle/views/media/media_extra_field_create_form.php');

	}

?>