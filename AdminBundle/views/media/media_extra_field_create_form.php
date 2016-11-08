<?php

if (isset($media_extra)) {
	if (isset($languages)) {
		foreach ($media_extra as $id_info_field => $value) {
			if (strcmp($value['type'], 'Text') == 0) {

				foreach ($languages as $language) {

					$user_value = "";
					if (isset($media_user_extras[$id_info_field]['language'][$language['id']]['data']))
						$user_value = $media_user_extras[$id_info_field]['language'][$language['id']]['data'];
?>
					<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] . ' - ' . $language['code'] ?> : </label>
					<input type="text" name="media_extra_mediastorage[<?= $id_info_field ?>][language][<?= $language['id'] ?>][data]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="<?= $user_value ?>" /><br />
					<div class="clear"></div>
<?php
				}
?>
				<label></label>
				<div class="clear"></div>
<?php

			}
			elseif (strcmp($value['type'], 'Date') == 0) {

				$user_value = "";
				if (isset($media_user_extras[$id_info_field]['data']))
					$user_value = $media_user_extras[$id_info_field]['data'];
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<input type="text" name="media_extra_mediastorage[<?= $id_info_field ?>][data]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="" /><br />
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<select multiple name="media_extra_mediastorage[<?= $id_info_field ?>][multiple][][id_array]" id="media_extra_mediastorage_<?= $id_info_field ?>" />
<?php
					foreach ($value['data'] as $row) {

						if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {
							$user_value = "";
							if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false)
								$user_value = "selected";

							echo '<option value="' . $row['id_element'] . '" ' . $user_value . ' >' . $row['element'] . '</option>';
						}
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
				<select name="media_extra_mediastorage[<?= $id_info_field ?>][id_array]" id="media_extra_mediastorage_<?= $id_info_field  ?>" />
<?php
					foreach ($value['data'] as $row) {

						if ((intval($row['id_language']) == intval($_SESSION['id_language_mediastorage'])) && (intval($row['id_language_array']) == intval($_SESSION['id_language_mediastorage']))) {
							$user_value = "";
							if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array']))
								$user_value = "selected";

							echo '<option value="' . $row['id_element'] . '" ' . $user_value . ' >' . $row['element'] . '</option>';
						}
					}
?>
				</select>
				<div class="clear"></div>
<?php
			}
			elseif (strcmp($value['type'], 'Boolean') == 0) {

				$user_value = "";
				if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
					$user_value = "checked";
?>
				<input type="hidden" name="media_extra_mediastorage[<?= $id_info_field ?>][data]" value="0" />
				<label for="media_extra_mediastorage_<?= $id_info_field ?>"><?= $value['data'][0]['data'] ?> : </label>
				<input type="checkbox" class="input_checkbox" name="media_extra_mediastorage[<?= $id_info_field ?>][data]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="1" <?= $user_value ?> />
				<div class="clear"></div>
<?php
			}
		}
	}
}