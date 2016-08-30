<?php

if (isset($media_extra)) {

		foreach ($media_extra as $id_info_field => $value) {
			if (strcmp($value['type'], 'Text') == 0) {


				$user_value = "";
				if (isset($media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data']))
					$user_value = $media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data'];
?>
	            <tr>
	                <th><?= $value['data'][0]['data'] ?> :</th>
	                <td><?= $user_value ?></td>
	            </tr>
<?php

			}
			elseif (strcmp($value['type'], 'Date') == 0) {

				$user_value = "";
				if (isset($media_user_extras[$id_info_field]['data']))
					$user_value = $media_user_extras[$id_info_field]['data'];
?>
                <tr>
                    <th><?= $value['data'][0]['data'] ?> :</th>
                    <td><?= $user_value ?></td>
                </tr>
<?php
			}
			elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>

                <tr>
                    <th><?= $value['data'][0]['data'] ?> :</th>
<?php
					foreach ($value['data'] as $row) {

						$user_value = "";
						if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false) {
?>
							<td><?= $row['element'] ?></td>
<?php
						}
					}

?>
                </tr>
<?php
			}
			elseif (strcmp($value['type'], 'Array_unique') == 0) {
?>
                <tr>
                    <th><?= $value['data'][0]['data'] ?> :</th>
<?php
					foreach ($value['data'] as $row) {

						$user_value = "";
						if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array'])) {
?>
		                    <td><?= $row['element'] ?></td>
<?php
						}
					}
?>
                </tr>
<?php
			}
			elseif (strcmp($value['type'], 'Boolean') == 0) {

				$user_value = "";
				if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
					$user_value = "checked";
?>
                <tr>
                    <th><?= $value['data'][0]['data'] ?> :</th>
                    <td>
                    	<input type="checkbox" class="input_checkbox" name="media_extra_mediastorage[<?= $id_info_field ?>][data]" id="media_extra_mediastorage_<?= $id_info_field ?>" value="1" <?= $user_value ?> disabled />
                    </td>
                </tr>
<?php
			}
		}
}