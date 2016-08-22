<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_parent_mediastorage">Dossier parent</label>
		<select name="id_parent_mediastorage[]" id="id_parent_mediastorage" class="parent_mediastorage">
			<option value=""></option>
<?php
			while ($folder = $folders['data']->fetch_assoc()) {
				echo '<option value="' . $folder['id'] . '" >' . $folder['translate'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>

<?php
			$cpt = 0;
			while ($language = $languages['data']->fetch_assoc()) {
?>
				<label for="data_mediastorage_<?= $cpt ?>" ><?= LANGUAGE_TRANSLATE . ' ' . $language['name'] . ' / ' . $language['code'] ?> : </label>
				<input type="text" name="data_mediastorage[<?= $language['id'] ?>]" id="data_mediastorage_<?= $cpt ?>" value="<?= (isset($folder_language[intval($language['id'])])) ? $folder_language[intval($language['id'])]['data'] : '' ?>" /><br />
				<div class="clear"></div>
<?php
				$cpt++;
			}
?>
		<input type="hidden" name="id_folder_create_mediastorage" value="984156" />

		<a id="cancel_button" class="form_button" href="?page=list_organization_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>