<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="role_mediastorage"><?= ROLE ?></label>
	<input type="text" name="role_mediastorage" id="role_mediastorage" value="<?= (isset($role['role'])) ? $role['role'] : '' ?>" /><br />

	<label for="id_organization_mediastorage"><?= ORGANIZATION ?></label>
	<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($role['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['name'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_role_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>