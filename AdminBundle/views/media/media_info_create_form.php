<?php
			$cpt = 0;
			while ($language = $languages['data']->fetch_assoc()) {
?>
				<h3><?= LANGUAGE_TRANSLATE . ' ' . $language['name'] . ' / ' . $language['code'] ?></h3>

				<label for="title_mediastorage_<?= $cpt ?>"><?= TITLE ?> : </label>
				<input type="text" name="title_mediastorage[<?= $language['id'] ?>]" id="title_mediastorage_<?= $cpt ?>" value="<?= (isset($media['title'])) ? $media['title'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="subtitle_mediastorage_<?= $cpt ?>"><?= SUBTITLE ?> : </label>
				<input type="text" name="subtitle_mediastorage[<?= $language['id'] ?>]" id="subtitle_mediastorage_<?= $cpt ?>" value="<?= (isset($media['subtitle'])) ? $media['subtitle'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="description_mediastorage_<?= $cpt ?>"><?= DESCRIPTION ?> : </label>
				<input type="text" name="description_mediastorage[<?= $language['id'] ?>]" id="description_mediastorage_<?= $cpt ?>" value="<?= (isset($media['description'])) ? $media['description'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="episode_number_mediastorage_<?= $cpt ?>"><?= EPISODE_NUMBER ?> : </label>
				<input type="text" name="episode_number_mediastorage[<?= $language['id'] ?>]" id="episode_number_mediastorage_<?= $cpt ?>" value="<?= (isset($media['episode_number'])) ? $media['episode_number'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="image_version_mediastorage_<?= $cpt ?>"><?= IMAGE_VERSION ?> : </label>
				<input type="text" name="image_version_mediastorage[<?= $language['id'] ?>]" id="image_version_mediastorage_<?= $cpt ?>" value="<?= (isset($media['image_version'])) ? $media['image_version'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="sound_version_mediastorage_<?= $cpt ?>"><?= SOUND_VERSION ?> : </label>
				<input type="text" name="sound_version_mediastorage[<?= $language['id'] ?>]" id="sound_version_mediastorage_<?= $cpt ?>" value="<?= (isset($media['sound_version'])) ? $media['sound_version'] : '' ?>" /><br />
				<div class="clear"></div>

				<label for="handover_date_mediastorage_<?= $cpt ?>"><?= HANDOVER_DATE ?> : </label>
				<input type="text" name="handover_date_mediastorage[<?= $language['id'] ?>]" id="handover_date_mediastorage_<?= $cpt ?>" value="<?= (isset($media['handover_date'])) ? $media['handover_date'] : '' ?>" /><br />
				<div class="clear"></div>


				<?php /*<label for="data_mediastorage_<?= $cpt ?>" ><?= LANGUAGE_TRANSLATE . ' ' . $language['name'] . ' / ' . $language['code'] ?> : </label>
				<input type="text" name="data_mediastorage[<?= $language['id'] ?>]" id="data_mediastorage_<?= $cpt ?>" value="<?= (isset($folder_language[intval($language['id'])])) ? $folder_language[intval($language['id'])]['data'] : '' ?>" /><br />
				<div class="clear"></div> */ ?>
<?php

				require('AdminBundle/views/media/media_extra_field_create_form.php');

				$cpt++;
			}
?>