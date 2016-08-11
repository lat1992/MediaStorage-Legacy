<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_group_mediastorage"><?= GROUP ?> : </label>
		<select name="id_group_mediastorage" id="id_group_mediastorage"/>
<?php
			$cpt = 0;
			while ($group = $groups['data']->fetch_assoc()) {
				echo '<option value="' . $group['id'] . '" ' . ((intval($organization['id_group']) == intval($group['id'])) ? 'selected' : '') . '>' . $group['name'] . '</option>';
				$cpt++;
			}
?>
		</select>
		<div class="clear"></div>

		<label for="reference_mediastorage"><?= REFERENCE ?> : </label>
		<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($organization['reference'])) ? $organization['reference'] : '' ?>" /><br />

		<label for="name_mediastorage"><?= NAME ?> : </label>
		<input type="text" name="name_mediastorage" id="name_mediastorage" value="<?= (isset($organization['name'])) ? $organization['name'] : '' ?>" /><br />

		<div class="clear"></div>

		<input type="hidden" name="id_organization_create_mediastorage" value="87463975" />

		<a id="cancel_button" class="form_button" href="?page=list_organization_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>