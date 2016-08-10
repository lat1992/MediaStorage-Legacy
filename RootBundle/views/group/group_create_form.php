<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<label for="reference_mediastorage"><?= REFERENCE ?> : </label>
		<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($group['reference'])) ? $group['reference'] : '' ?>" /><br />

		<label for="name_mediastorage"><?= NAME ?> : </label>
		<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($group['name'])) ? $group['name'] : '' ?>" /><br />

		<label for="fileserver_mediastorage"><?= FILESERVER ?> : </label>
		<input type="text" name="fileserver_mediastorage" id="fileserver_mediastorage" value="<?= (isset($group['fileserver'])) ? $group['fileserver'] : '' ?>" /><br />

		<input type="hidden" name="id_group_create_mediastorage" value="87463975" />

		<div class="clear"></div>

		<a id="cancel_button" class="form_button" href="?page=list_group_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>