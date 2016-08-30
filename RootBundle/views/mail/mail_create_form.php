<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
			$cpt = 0;
			while ($organization = $organizations['data']->fetch_assoc()) {
				echo '<option value="' . $organization['id'] . '" ' . (($id_organization == intval($organization['id'])) ? 'selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
				$cpt++;
			}
?>
		</select>
		<div class="clear"></div>

		<label for="mail_mediastorage"><?= EMAIL ?> : </label>
		<input type="text" name="mail_mediastorage" id="mail_mediastorage" value="<?= (isset($mail['email'])) ? $mail['email'] : '' ?>" /><br />

		<div class="clear"></div>

		<input type="hidden" name="id_mail_create_mediastorage" value="754351" />

		<a id="cancel_button" class="form_button" href="?page=list_mail_root&id_organization=<?= $id_organization ?>"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>