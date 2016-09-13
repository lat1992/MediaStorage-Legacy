<?php

require_once('RootBundle/views/layout/header.php');

?>
<link rel="stylesheet" href="RootBundle/ressources/design/css/design.css">
<script src="RootBundle/ressources/design/js/design.js"></script>

<div id="container">

	<form id="form" class="design-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<h2><?= LOGIN_PAGE ?></h2>

		<h3><?= GENERAL ?></h3>

		<label for="design_mediastorage[body][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[body][background-color][value]" id="design_mediastorage[body][background-color][value]" value="<?= (isset($designs['body']['background-color']['value'])) ? $designs['body']['background-color']['value'] : '#a6a6a6' ?>" />
		<input type="text" name="design_mediastorage[body][background-color][value]"  value="<?= (isset($designs['body']['background-color']['value'])) ? $designs['body']['background-color']['value'] : '#a6a6a6' ?>"><br />
		<input type="hidden" name="design_mediastorage[body][background-color][id]" value="<?= (isset($designs['body']['background-color']['id'])) ? $designs['body']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[body][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[body][color][value]" id="design_mediastorage[body][color][value]" value="<?= (isset($designs['body']['color']['value'])) ? $designs['body']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[body][color][value]" id="design_mediastorage[body][color][value]" value="<?= (isset($designs['body']['color']['value'])) ? $designs['body']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[body][color][id]" value="<?= (isset($designs['body']['color']['id'])) ? $designs['body']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= LOGIN_BLOCK ?></h3>

		<label for="design_mediastorage[.form][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form][background-color][value]" id="design_mediastorage[.form][background-color][value]" value="<?= (isset($designs['.form']['background-color']['value'])) ? $designs['.form']['background-color']['value'] : '#f2f2f2' ?>" />
		<input type="text" name="design_mediastorage[.form][background-color][value]" id="design_mediastorage[.form][background-color][value]" value="<?= (isset($designs['.form']['background-color']['value'])) ? $designs['.form']['background-color']['value'] : '#f2f2f2' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form][background-color][id]" value="<?= (isset($designs['.form']['background-color']['id'])) ? $designs['.form']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form][color][value]" id="design_mediastorage[.form][color][value]" value="<?= (isset($designs['.form']['color']['value'])) ? $designs['.form']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[.form][color][value]" id="design_mediastorage[.form][color][value]" value="<?= (isset($designs['.form']['color']['value'])) ? $designs['.form']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form][color][id]" value="<?= (isset($designs['.form']['color']['id'])) ? $designs['.form']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= BUTTON ?></h3>

		<label for="design_mediastorage[.form button][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form button][background-color][value]" id="design_mediastorage[.form button][background-color][value]" value="<?= (isset($designs['.form button']['background-color']['value'])) ? $designs['.form button']['background-color']['value'] : '#404040' ?>" />
		<input type="text" name="design_mediastorage[.form button][background-color][value]" id="design_mediastorage[.form button][background-color][value]" value="<?= (isset($designs['.form button']['background-color']['value'])) ? $designs['.form button']['background-color']['value'] : '#404040' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button][background-color][id]" value="<?= (isset($designs['.form button']['background-color']['id'])) ? $designs['.form button']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form button][color][value]" id="design_mediastorage[.form button][color][value]" value="<?= (isset($designs['.form button']['color']['value'])) ? $designs['.form button']['color']['value'] : '#d9d9d9' ?>" />
		<input type="text" name="design_mediastorage[.form button][color][value]" id="design_mediastorage[.form button][color][value]" value="<?= (isset($designs['.form button']['color']['value'])) ? $designs['.form button']['color']['value'] : '#d9d9d9' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button][color][id]" value="<?= (isset($designs['.form button']['color']['id'])) ? $designs['.form button']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'] : '#FED500' ?>" /><
		<input type="text" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'] : '#FED500' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][id]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['id'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['value'] : '#262626' ?>" />
		<input type="text" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['value'] : '#262626' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][id]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['id'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<input type="hidden" name="design_create_mediastorage" value="87463975" />
		<a id="cancel_button" class="form_button" href="?page=list_group_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
