<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<label for="role_mediastorage"><?= ROLE ?> : </label>
		<input type="text" name="role_mediastorage" id="role_mediastorage" value="<?= (isset($role['role'])) ? $role['role'] : '' ?>" /><br />

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == $id_organization) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
		}
?>
		</select>
		<div class="clear"></div>

		<label for="id_permit_mediastorage"><?= PERMIT ?> : </label>
		<select multiple name="id_permit_mediastorage[]" id="id_permit_mediastorage"/>
<?php
			while ($permit = $permits['data']->fetch_assoc()) {
					echo '<option value="' . $permit['id'] . '" ' . ((in_array($permit['id'], $selected_group_permit)) ? 'selected' : '') . '>' . $permit['permit'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>

		<label></label>
		<span class="info_multiple_select"><?= INFO_MULTIPLE_SELECT ?></span>
		<div class="clear"></div>

		<label for="id_language_mediastorage"><?= LANGUAGE ?> : </label>
		<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
			$cpt = 0;
			while ($language = $languages['data']->fetch_assoc()) {
				if ($cpt != 0) {
					echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($role['id_language'])) ? ' selected' : '') . '>' . $language['name'] . ' / ' . $language['code'] . '</option>';
				}
				$cpt++;
			}
?>
		</select>
		<div class="clear"></div>

		<label for="data_mediastorage"><?= LANGUAGE_TRANSLATE ?> : </label>
		<input type="text" name="data_mediastorage" id="data_mediastorage" value="<?= (isset($role['data'])) ? $role['data'] : '' ?>" /><br />
		<div class="clear"></div>

		<input type="hidden" name="id_role_create_mediastorage" value="984156" />

		<a id="cancel_button" class="form_button" href="?page=list_role_root&id_organization=<?= $id_organization ?>"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>