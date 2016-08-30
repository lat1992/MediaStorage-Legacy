<div id="container">

	<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
		<label for="username_mediastorage"><?= USERNAME ?> : </label>
		<input type="text" name="username_mediastorage" id="username_mediastorage" value="<?= (isset($user['username'])) ? $user['username'] : '' ?>" /><br />

		<label for="password_mediastorage"><?= PASSWORD ?> : </label>
		<input type="password" name="password_mediastorage" id="password_mediastorage" /><br />

		<label for="password_mediastorage_bis"><?= PASSWORD_BIS ?> : </label>
		<input type="password" name="password_mediastorage_bis" id="password_mediastorage_bis"/><br />

		<label for="id_organization_mediastorage"><?= ORGANIZATION ?> : </label>
		<select name="id_organization_mediastorage" id="id_organization_mediastorage"/>
<?php
			while ($organization = $organizations['data']->fetch_assoc()) {
				echo '<option value="' . $organization['id'] . '" ' . ((intval($organization['id']) == intval($user['id_organization'])) ? ' selected' : '') . '>' . $organization['reference'] . ' / ' . $organization['organization_name'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>


		<label for="id_role_mediastorage"><?= ROLE ?> : </label>
		<select name="id_role_mediastorage" id="id_role_mediastorage"/>
<?php
			while ($role = $roles['data']->fetch_assoc()) {
				echo '<option value="' . $role['id'] . '" ' . ((intval($role['id']) == intval($user['id_role'])) ? ' selected' : '') . '>' . $role['role'] . '</option>';
			}
?>
		</select>
		<div class="clear"></div>


		<label for="id_language_mediastorage"><?= LANGUAGE ?> : </label>
		<select name="id_language_mediastorage" id="id_language_mediastorage"/>
<?php
			while ($language = $languages['data']->fetch_assoc()) {
				if ($language['id'] != 1) {
					echo '<option value="' . $language['id'] . '" ' . ((intval($language['id']) == intval($user['id_language'])) ? ' selected' : '') . '>' . $language['name'] . '</option>';
				}
			}
?>
		</select>
		<div class="clear"></div>


		<label for="first_name_mediastorage"><?= FIRST_NAME ?> : </label>
		<input type="text" name="first_name_mediastorage" id="first_name_mediastorage" value="<?= (isset($user['first_name'])) ? $user['first_name'] : '' ?>"/><br />

		<label for="last_name_mediastorage"><?= LAST_NAME ?> : </label>
		<input type="text" name="last_name_mediastorage" id="last_name_mediastorage" value="<?= (isset($user['last_name'])) ? $user['last_name'] : '' ?>"/><br />

		<label for="company_mediastorage"><?= COMPANY ?> : </label>
		<input type="text" name="company_mediastorage" id="company_mediastorage" value="<?= (isset($user['company'])) ? $user['company'] : '' ?>"/><br />

		<label for="job_mediastorage"><?= JOB ?> : </label>
		<input type="text" name="job_mediastorage" id="job_mediastorage" value="<?= (isset($user['job'])) ? $user['job'] : '' ?>"/><br />

		<label for="email_mediastorage"><?= EMAIL ?> : </label>
		<input type="email" name="email_mediastorage" id="email_mediastorage" value="<?= (isset($user['email'])) ? $user['email'] : '' ?>" /><br />

		<label for="address_mediastorage"><?= ADDRESS ?> : </label>
		<input type="text" name="address_mediastorage" id="address_mediastorage" value="<?= (isset($user['address'])) ? $user['address'] : '' ?>"/><br />

		<label for="zipcode_mediastorage"><?= ZIPCODE ?> : </label>
		<input type="text" name="zipcode_mediastorage" id="zipcode_mediastorage" value="<?= (isset($user['zipcode'])) ? $user['zipcode'] : '' ?>"/><br />

		<label for="city_mediastorage"><?= CITY ?> : </label>
		<input type="text" name="city_mediastorage" id="city_mediastorage" value="<?= (isset($user['city'])) ? $user['city'] : '' ?>"/><br />

		<label for="country_mediastorage"><?= COUNTRY ?> : </label>
		<input type="text" name="country_mediastorage" id="country_mediastorage" value="<?= (isset($user['country'])) ? $user['country'] : '' ?>"/><br />

		<label for="phone_mediastorage"><?= PHONE ?> : </label>
		<input type="tel" name="phone_mediastorage" id="phone_mediastorage" value="<?= (isset($user['phone'])) ? $user['phone'] : '' ?>"/><br />

		<label for="mobile_mediastorage"><?= MOBILE ?> : </label>
		<input type="tel" name="mobile_mediastorage" id="mobile_mediastorage" value="<?= (isset($user['mobile'])) ? $user['mobile'] : '' ?>"/><br />

		<div class="clear"></div>

		<input type="hidden" name="id_user_create_mediastorage" value="98475" />

		<a id="cancel_button" class="form_button" href="?page=list_user_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>
	</form>

</div>