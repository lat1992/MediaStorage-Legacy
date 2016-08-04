<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="reference_mediastorage"><?= REFERENCE ?></label>
	<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($organization['reference'])) ? $organization['reference'] : '' ?>" /><br />

	<label for="name_mediastorage"><?= NAME ?></label>
	<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($organization['name'])) ? $organization['name'] : '' ?>" /><br />

	<label for="id_group_mediastorage"><?= GROUP ?></label>
	<select name="id_group_mediastorage" id="id_group_mediastorage"/>
<?php
		while ($group = $groups['data']->fetch_assoc()) {
			echo '<option value="' . $group['id'] . '" ' . ((intval($group['id']) == intval($organization['id_group'])) ? ' selected' : '') . '>' . $group['reference'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_organization_create_mediastorage" value="87463975" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>