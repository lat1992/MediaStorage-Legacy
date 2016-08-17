<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<label for="reference_group_mediastorage"><?= REFERENCE ?> : </label>
		<input type="text" name="reference_group_mediastorage" id="reference_group_mediastorage" value="<?= (isset($group['reference'])) ? $group['reference'] : '' ?>" /><br />

		<label for="name_group_mediastorage"><?= NAME ?> : </label>
		<input type="text" name="name_group_mediastorage" id="name_group_mediastorage" value="<?= (isset($group['name'])) ? $group['name'] : '' ?>" /><br />

		<label for="fileserver_mediastorage"><?= FILESERVER ?> : </label>
		<input type="text" name="fileserver_mediastorage" id="fileserver_mediastorage" value="<?= (isset($group['fileserver'])) ? $group['fileserver'] : '' ?>" /><br />

		<label for="id_language_mediastorage"><?= LANGUAGE ?> : </label>
		<select multiple name="id_language_mediastorage[]" id="id_language_mediastorage"/>
<?php
			$cpt = 0;
			while ($language = $languages['data']->fetch_assoc()) {
				if ($cpt != 0) {
					echo '<option value="' . $language['id'] . '" ' . ((in_array($language['id'], $selected_group_language)) ? 'selected' : '') . '>' . $language['name'] . ' / ' . $language['code'] . '</option>';
				}
				$cpt++;
			}
?>
		</select>
		<div class="clear"></div>

		<label></label>
		<span class="info_multiple_select"><?= INFO_MULTIPLE_SELECT ?></span>
		<div class="clear"></div>

<?php
		if (!isset($_GET['group_id'])) {
?>
			<label style="font-weight: bold;margin-top: 30px"><?= ORGANIZATION ?></label>
			<div class="clear"></div>

			<label for="reference_mediastorage"><?= REFERENCE ?> : </label>
			<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($organization['reference'])) ? $organization['reference'] : '' ?>" /><br />

			<label for="name_mediastorage"><?= NAME ?> : </label>
			<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($organization['name'])) ? $organization['name'] : '' ?>" /><br />
<?php
		}
?>
		<div class="clear"></div>

		<input type="hidden" name="id_group_create_mediastorage" value="87463975" />

		<a id="cancel_button" class="form_button" href="?page=list_group_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>