<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="email_mediastorage"><?= EMAIL ?></label>
	<input type="email" name="email_mediastorage" id="email_mediastorage" value="<?= (isset($maillist['email'])) ? $maillist['email'] : '' ?>" /><br />

	<label for="id_organization_mediastorage"><?= ORGANIZATION ?></label>
	<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($maillist['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['name'] . '</option>';
		}
?>
	</select>
	<br />

	<input type="hidden" name="id_maillist_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>