<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

	<label for="id_role_mediastorage"><?= ROLE ?></label>
	<select name="id_role_mediastorage" id="id_role_mediastorage"/>
<?php
		while ($role = $roles['data']->fetch_assoc()) {
			echo '<option value="' . $role['id'] . '" ' . ((intval($role['id']) == intval($role_permit['id_role'])) ? ' selected' : '') . '>' . $role['role'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_permit_mediastorage"><?= PERMIT ?></label>
	<select name="id_permit_mediastorage" id="id_permit_mediastorage"/>
<?php
		while ($permit = $permits['data']->fetch_assoc()) {
			echo '<option value="' . $permit['id'] . '" ' . ((intval($permit['id']) == intval($role_permit['id_permit'])) ? ' selected' : '') . '>' . $permit['permit'] . '</option>';
		}
?>

	<input type="hidden" name="id_role_permit_create_mediastorage" value="7645" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>