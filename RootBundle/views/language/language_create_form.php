<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="name_mediastorage"><?= NAME ?> : </label>
		<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($language['name'])) ? $language['name'] : '' ?>" /><br />

		<label for="code_mediastorage"><?= CODE ?> : </label>
		<input type="text" name="code_mediastorage" id="code_mediastorage" value="<?= (isset($language['code'])) ? $language['code'] : '' ?>" /><br />

		<div class="clear"></div>

		<input type="hidden" name="id_language_create_mediastorage" value="984156" />

		<a id="cancel_button" class="form_button" href="?page=list_language_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>