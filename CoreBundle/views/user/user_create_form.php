<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">
	<label for="username_mediastorage"><?= USERNAME ?></label>
	<input type="text" name="username_mediastorage" id="username_mediastorage"/>
	<label for="password_mediastorage"><?= PASSWORD ?></label>
	<input type="password" name="password_mediastorage" id="password_mediastorage"/>
	<label for="password_mediastorage_bis"><?= PASSWORD_BIS ?></label>
	<input type="password" name="password_mediastorage_bis" id="password_mediastorage_bis"/>
	<input type="hidden" name="id_user_create_mediastorage" value="98475" />
	<input type="submit" value="<?= VALIDATE ?>" />
</form>