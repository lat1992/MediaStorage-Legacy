<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="reference_mediastorage"><?= REFERENCE ?> : </label>
		<input type="text" name="reference_mediastorage" id="reference_mediastorage" /><br />

<?php

		require_once('RootBundle/views/common/table_list.php');

?>

	<input type="hidden" name="id_sharelist_create_mediastorage" value="895143" />

	<a id="cancel_button" class="form_button" href="?page=list_content_admin"><?= CANCEL ?></a>
	<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>