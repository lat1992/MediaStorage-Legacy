<?php

require_once('RootBundle/views/layout/header.php');

?>

<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
			$cpt = 0;
			while ($organization = $organizations['data']->fetch_assoc()) {
				echo '<option value="' . $organization['id'] . '">' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
				$cpt++;
			}
?>
		</select>
		<div class="clear"></div>

		<input type="hidden" name="id_media_info_extra_field_mediastorage" value="4894565">

		<a id="cancel_button" class="form_button" href="?page=dashboard_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= NEXT ?></a>

	</form>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
