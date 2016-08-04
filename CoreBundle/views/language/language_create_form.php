<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="name_mediastorage"><?= NAME ?></label>
	<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($language['name'])) ? $language['name'] : '' ?>" /><br />

	<label for="code_mediastorage"><?= CODE ?></label>
	<input type="text" name="code_mediastorage" id="code_mediastorage" value="<?= (isset($language['code'])) ? $language['code'] : '' ?>" /><br />

	<input type="hidden" name="id_language_create_mediastorage" value="984156" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>