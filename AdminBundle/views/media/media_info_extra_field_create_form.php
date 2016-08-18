<?php

if (isset($media_extra)) {

	$id_language = intval($language['id']);

	if (isset($media_extra[$id_language])) {
		foreach ($media_extra[$id_language] as $id_info_field => $value) {
			if (strcmp($value['type'], 'Text') == 0) {
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<input type="text" name="media_extra_mediastorage[<?= $language['id'] ?>][<?= $id_info_field ?>]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="" /><br />
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Date') == 0) {
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<input type="text" name="media_extra_mediastorage[<?= $language['id'] ?>][<?= $id_info_field ?>]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="" /><br />
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<select multiple name="media_extra_mediastorage[<?= $language['id'] ?>][<?= $id_info_field ?>][]" id="media_extra_mediastorage_<?= $id_info_field ?>" />
<?php
					foreach ($value['data'] as $row) {
						echo '<option value="' . $row['id_element'] . '" >' . $row['element'] . '</option>';
					}
?>
				</select>
				<div class="clear"></div>

				<label></label>
				<span class="info_multiple_select"><?= INFO_MULTIPLE_SELECT ?></span>
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Array_unique') == 0) {
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<select name="media_extra_mediastorage[<?= $language['id'] ?>][<?= $id_info_field ?>]" id="media_extra_mediastorage_<?= $id_info_field  ?>" />
<?php
					foreach ($value['data'] as $row) {
						echo '<option value="' . $row['id_element'] . '" >' . $row['element'] . '</option>';
					}
?>
				</select>
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Boolean') == 0) {
?>
				<input type="hidden" name="media_extra_mediastorage_<?= $id_info_field ?>" value="0" />
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<input type="checkbox" class="input_checkbox" name="media_extra_mediastorage[<?= $language['id'] ?>][<?= $id_info_field ?>]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="1" />
				<div class="clear"></div>
<?php
			}
		}
	}
}