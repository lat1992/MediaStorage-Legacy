<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage" disabled />
<?php
			$cpt = 0;
			while ($organization = $organizations['data']->fetch_assoc()) {
				echo '<option value="' . $organization['id'] . '" ' . (($id_organization == intval($organization['id'])) ? 'selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
				$cpt++;
			}
?>
		</select>
		<input type="hidden" name="id_organization_mediastorage" id="id_organization_mediastorage" value="<?= $id_organization ?>"/>
		<div class="clear"></div>

		<label for="type_mediastorage"><?= TYPE ?> : </label>
		<select name="type_mediastorage" id="type_mediastorage"/>
			<option value="Text" <?php if (isset($mediaExtraField['type']) && !strcmp('Text', $mediaExtraField['type'])) echo ' selected' ?>><?= TEXT ?></option>
			<option value="Date" <?php if (isset($mediaExtraField['type']) && !strcmp('Date', $mediaExtraField['type'])) echo ' selected' ?>><?= DATE ?></option>
			<option value="Array_multiple" <?php if (isset($mediaExtraField['type']) && !strcmp('Array_multiple', $mediaExtraField['type'])) echo ' selected' ?>><?= ARRAY_MUTIPLE ?></option>
			<option value="Array_unique" <?php if (isset($mediaExtraField['type']) && !strcmp('Array_unique', $mediaExtraField['type'])) echo ' selected' ?>><?= ARRAY_UNIQUE ?></option>
			<option value="Boolean" <?php if (isset($mediaExtraField['type']) && !strcmp('Boolean', $mediaExtraField['type'])) echo ' selected' ?>><?= T_BOOLEAN ?></option>
		</select>
		<div class="clear"></div>

		<label for="mandatory_mediastorage"><?= MANDATORY ?> : </label>
		<input type="hidden" name="mandatory_mediastorage" id="mandatory_mediastorage" value="0"/>
		<input type="checkbox" class="input_checkbox" name="mandatory_mediastorage" id="mandatory_mediastorage" value="1" <?= (isset($mediaExtraField['mandatory']) && intval($mediaExtraField['mandatory']) == 1) ? 'checked' : '' ?> /><br />
		<div class="clear"></div>
<?php
		while ($groupLanguage = $groupLanguages['data']->fetch_assoc()) {
			$mediaExtraFieldLanguageText = '';
			echo '<label for="media_extra_field_language_data_mediastorage['. $groupLanguage['id'] .']">' . LANGUAGE_TRANSLATE . ' (' . $groupLanguage['name'] . ') : </label>';
			if (isset($mediaExtraFieldLanguage[intval($groupLanguage['id'])]))
				$mediaExtraFieldLanguageText = $mediaExtraFieldLanguage[intval($groupLanguage['id'])]['data'];
			echo '<input type="text" name="media_extra_field_language_data_mediastorage['. $groupLanguage['id'] .']" id="media_extra_field_language_data_mediastorage['. $groupLanguage['id'] .']" value="'. $mediaExtraFieldLanguageText .'"></br>';
		}
?>

		<div class="clear"></div>

		<input type="hidden" name="id_media_extra_field_create_mediastorage" value="4894565" />

		<a id="cancel_button" class="form_button" href="?page=list_media_extra_field_root&id_organization=<?= $id_organization ?>" ><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>