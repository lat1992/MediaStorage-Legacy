<?php
        foreach ($media_extra_field as $key => $value) {
?>
			<label><?= $value['name'] ?></label>
<?php
			if (strcmp($value['type'], 'Text') == 0) {
?>
				<input type="text" name="<?= $value['id'] ?>" />
<?php
			}
			elseif (strcmp($value['type'], 'Date') == 0) {
?>
				<input type="text" name="<?= $value['id'] ?>" />
<?php
			}
			elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>
				<select multiple name="<?= $value['id'] ?>" />
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
				<select name="<?= $value['id'] ?>" />
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
?>
			<div class="clear"></div>
<?php
       }
?>