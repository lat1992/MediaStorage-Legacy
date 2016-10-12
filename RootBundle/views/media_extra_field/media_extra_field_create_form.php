	<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage" />
<?php
			while ($organization = $organizations['data']->fetch_assoc()) {
				echo '<option value="' . $organization['id'] . '" ' . (($id_organization == intval($organization['id'])) ? 'selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>

		<label for="id_mediatype_mediastorage"><?= MEDIA_TYPE ?> : </label>
		<select name="id_mediatype_mediastorage" id="id_mediatype_mediastorage" />
<?php
			foreach ($mediaTypes as $mediaType) {
				echo '<option value="' . $mediaType['id'] . '" ' . ((intval($mediaType['id']) == intval($mediaTypeField['id_type'])) ? 'selected' : '') . '>' . $mediaType['type'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>

		<label for="type_mediastorage"><?= TYPE ?> : </label>
		<select name="type_mediastorage" id="type_mediastorage"/>
			<option value="Text" id="1" <?php if (isset($mediaExtraField['type']) && !strcmp('Text', $mediaExtraField['type'])) echo ' selected' ?>><?= TEXT ?></option>
			<option value="Date" id="2" <?php if (isset($mediaExtraField['type']) && !strcmp('Date', $mediaExtraField['type'])) echo ' selected' ?>><?= DATE ?></option>
			<option value="Array_multiple" id="3" <?php if (isset($mediaExtraField['type']) && !strcmp('Array_multiple', $mediaExtraField['type'])) echo ' selected' ?>><?= ARRAY_MUTIPLE ?></option>
			<option value="Array_unique" id="4" <?php if (isset($mediaExtraField['type']) && !strcmp('Array_unique', $mediaExtraField['type'])) echo ' selected' ?>><?= ARRAY_UNIQUE ?></option>
			<option value="Boolean" id="5" <?php if (isset($mediaExtraField['type']) && !strcmp('Boolean', $mediaExtraField['type'])) echo ' selected' ?>><?= T_BOOLEAN ?></option>
		</select>
		<div class="clear"></div>

		<div id="dynamic_data">
<?php
			if (isset($mediaExtraArray)) {
				$cpt = 0;
				foreach ($mediaExtraArray as $key => $data) {
					$cptbis = 0;
					foreach ($groupLanguages as $groupLanguage) {
						echo '<label>' . TABLE_VALUE . ' ' . ($key + 1) . ' (' . $groupLanguage['name'] . '): </label><input name="media_extra_field_array_data_mediastorage[' . $key . '][' . $groupLanguage['id'] . ']" class="array_input" type="text" value="' . $data[$groupLanguage['id']] . '" data-id="' . $key . '"/>';
						if ($cpt == 0) {
							echo '<a href="#" style="display: inline-block; float: left; margin: 10px 0 10px 10px; text-decoration: none;" id="add_array_field" >( + )</a><div class="clear"></div>';
						}
						elseif ($cptbis == 0) {
							echo '<a href="?page=delete_media_extra_array_root&media_extra_field_id=' . $_GET['media_extra_field_id'] . '&id_order=' . $key . '" style="display: inline-block; float: left; margin: 10px 0 10px 10px; text-decoration: none;" >( - )</a>';
						}
						else {
							echo '<div class="clear"></div>';
						}
						$cpt++;
						$cptbis++;
					}
				}
			}
?>
		</div>
		<div class="clear"></div>

		<label for="mandatory_mediastorage"><?= MANDATORY ?> : </label>
		<input type="hidden" name="mandatory_mediastorage" id="mandatory_mediastorage" value="0"/>
		<input type="checkbox" class="input_checkbox" name="mandatory_mediastorage" id="mandatory_mediastorage" value="1" <?= (isset($mediaExtraField['mandatory']) && intval($mediaExtraField['mandatory']) == 1) ? 'checked' : '' ?> /><br />
		<div class="clear"></div>
<?php
		foreach ($groupLanguages as $groupLanguage) {
			$mediaExtraFieldLanguageText = '';
			echo '<label for="media_extra_field_language_data_mediastorage['. $groupLanguage['id'] .']">' . FIELD_NAME . ' (' . $groupLanguage['name'] . ') : </label>';
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

<script>

$( document ).ready(function() {

    $('form').on('change', '#type_mediastorage', function (){
        var elem = this
        let html = '';

        // console.log(elem);
        console.log(this.value);
        console.log('Array_multiple');

        if (this.value === "Array_multiple" || this.value === "Array_unique") {
        	html = '<div data-id="' + (($('.array_input').last().data('id')) + 1) + '"><?php
			$cpt = 0;
			foreach ($groupLanguages as $groupLanguage) {
				echo '<label>' . TABLE_VALUE . ' 1 (' . $groupLanguage['name'] . '): </label><input name="media_extra_field_array_data_mediastorage[0][' . $groupLanguage['id'] . ']" class="array_input" type="text" data-id="0" />';
				if ($cpt == 0) {
					echo '<a href="#" style="display: inline-block; float: left; margin: 10px 0 10px 10px; text-decoration: none;" id="add_array_field" >( + )</a><div class="clear"></div>';
				}
				else {
					echo '<div class="clear"></div>';
				}
				$cpt++;
			}
			?></div>';
        }

        $('#dynamic_data').html(html);

	    $('#add_array_field').on('click', function(){

	    	html = '<div data-id="' + (($('.array_input').last().data('id')) + 1) + '"><?php
			$cpt = 0;
			foreach ($groupLanguages as $groupLanguage) {
				echo '<label>' . TABLE_VALUE . ' \' + (($(\'.array_input\').last().data(\'id\')) + 2) + \' (' . $groupLanguage['name'] . '): </label><input name="media_extra_field_array_data_mediastorage[\' + (($(\'.array_input\').last().data(\'id\')) + 1) + \'][' . $groupLanguage['id'] . ']" class="array_input" data-id="\' + (($(\'.array_input\').last().data(\'id\')) + 1) + \'" type="text" />';
				echo '<div class="clear"></div>';
				$cpt++;
			}
			?></div>';

	        $('#dynamic_data').children().last().after(html);

			$('.delete_extra_array').on('click', function() {
		    	$('div[data-id=' + $(this).data('id') + ']').remove();
		    });

	    });
    });

    $('#add_array_field').on('click', function() {

    	html = '<div data-id="' + (($('.array_input').last().data('id')) + 1) + '"><?php
		$cpt = 0;
		foreach ($groupLanguages as $groupLanguage) {

			echo '<label>' . TABLE_VALUE . ' \' + (($(\'.array_input\').last().data(\'id\')) + 2) + \' (' . $groupLanguage['name'] . '): </label><input name="media_extra_field_array_data_mediastorage[\' + (($(\'.array_input\').last().data(\'id\')) + 1) + \'][' . $groupLanguage['id'] . ']" class="array_input" type="text" data-id="\' + (($(\'.array_input\').last().data(\'id\')) + 1) + \'" />';

			if ($cpt == 0) {
				echo '<a href="#" class="delete_extra_array" style="display: inline-block; float: left; margin: 10px 0 10px 10px; text-decoration: none;" data-id="\' + (($(\'.array_input\').last().data(\'id\')) + 1) + \'">( - )</a>';
			}

			echo '<div class="clear"></div>';

			$cpt++;
		}
		?></div>';

    	$('#dynamic_data').children().last().after(html);

		$('.delete_extra_array').on('click', function() {
	    	$('div[data-id=' + $(this).data('id') + ']').remove();
	    });

    });

});

</script>
