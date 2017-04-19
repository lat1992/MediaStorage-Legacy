<?php
        foreach ($media_extra_field as $key => $value) {
?>
			<label><?= $value['name'] ?></label>
<?php
			if (strcmp($value['type'], 'Text') == 0) {
?>
				<input type="text" name="text[<?= $value['id'] ?>]" />
<?php
			}
			elseif (strcmp($value['type'], 'Date') == 0) {
?>
				<input type="text" name="date[<?= $value['id'] ?>]" />
<?php
			}
			elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>
				<select multiple name="array_multiple[<?= $value['id'] ?>][]" />
<?php
				foreach ($value['data'] as $key_1 => $value_1) {
?>
					<option value="<?= $key_1 ?>"><?= $value_1 ?></option>
<?php
				}
?>
				</select>
<?php
			}
			elseif (strcmp($value['type'], 'Array_unique') == 0) {
?>
				<select name="array_unique[<?= $value['id'] ?>]" />
				<option value=""></option>
<?php
				foreach ($value['data'] as $key_1 => $value_1) {
?>
					<option value="<?= $key_1 ?>"><?= $value_1 ?></option>
<?php
				}
?>
				</select>
<?php
			}
       }
?>