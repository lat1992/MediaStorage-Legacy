<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">


	<label for="id_parent_mediastorage"><?= MEDIA_PARENT ?></label>
	<select name="id_parent_mediastorage" id="id_parent_mediastorage"/>
	<option value="NULL"><?= null ?></option>
<?php
	var_dump($parents['data']);
		while ($parent = $parents['data']->fetch_assoc()) {
			echo '<option value="' . $parent['id'] . '" ' . ((intval($parent['id']) == intval($media['id_parent'])) ? ' selected' : '') . '>' . $parent['reference'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_organization_mediastorage"><?= ORGANIZATION ?></label>
	<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
			echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($media['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['name'] . '</option>';
		}
?>
	</select>
	<br />

	<label for="id_type_mediastorage"><?= MEDIA_TYPE ?></label>
	<select name="id_type_mediastorage" id="id_type_mediastorage"/>
	<option value="1" <?php if (isset($media['id_type']) && $media['id_type'] == 1) echo 'selected' ?>><?= MEDIA_TYPE_PROGRAMME ?>
	<option value="2" <?php if (isset($media['id_type']) && $media['id_type'] == 2) echo 'selected' ?>><?= MEDIA_TYPE_CONTENT ?>
	<option value="3" <?php if (isset($media['id_type']) && $media['id_type'] == 3) echo 'selected' ?>><?= MEDIA_TYPE_ESSENCE ?>
	</select>
	<br />

	<label for="reference_mediastorage"><?= MEDIA_REFERENCE ?></label>
	<input type="text" name="reference_mediastorage" id="reference_mediastorage" value="<?= (isset($media['reference'])) ? $media['reference'] : '' ?>" />
	<br />

	<label for="right_view_mediastorage"><?= MEDIA_RIGHT_VIEW ?></label>
	<select name="right_view_mediastorage" id="right_view_mediastorage"/>
	<option value="1" <?php if (isset($media['right_view']) && $media['right_view'] == 1) echo 'selected' ?>><?= YES ?></option>
	<option value="0" <?php if (isset($media['right_view']) && $media['right_view'] == 0) echo 'selected' ?>><?= NO ?></option>
	</select>
	<br />

	<label for="right_download_mediastorage"><?= MEDIA_RIGHT_DOWNLOAD ?></label>
	<select name="right_download_mediastorage" id="right_download_mediastorage"/>
	<option value="1" <?php if (isset($media['right_view']) && $media['right_view'] == 1) echo 'selected' ?>><?= YES ?></option>
	<option value="0" <?php if (isset($media['right_view']) && $media['right_view'] == 0) echo 'selected' ?>><?= NO ?></option>
	</select>
	<br />

	<input type="hidden" name="id_media_create_mediastorage" value="895143" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>