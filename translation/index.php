<?php 

$settings = parse_ini_file('config.ini.php', true);

if (isset($_SESSION['username_mediastorage']) && isset($_SESSION['role_mediastorage']) && isset($_SESSION['language_mediastorage'])) {
	if (file_exists('translation/language_' . $_SESSION['language_mediastorage'] . '.php')) {
		if (file_exists('translation/custom/language_'.$_GET['platform'].'_' . $_SESSION['language_mediastorage'] . '.php'))
			require_once('custom/language_'.$_GET['platform'].'_' . $_SESSION['language_mediastorage'] . '.php');
		else
			require_once('language_' . $_SESSION['language_mediastorage'] . '.php');
	}
	else {
		if (file_exists('translation/custom/language_'.$_GET['platform'].'_' . $settings['language']['default'] . '.php'))
			require_once('custom/language_'.$_GET['platform'].'_' . $settings['language']['default'] . '.php');
		else
			require_once('language_' . $settings['language']['default'] . '.php');
	}
}
else {
	if (file_exists('translation/custom/language_'.$_GET['platform'].'_' . $settings['language']['default'] . '.php'))
		require_once('custom/language_'.$_GET['platform'].'_' . $settings['language']['default'] . '.php');
	else
		require_once('language_' . $settings['language']['default'] . '.php');
}

?>