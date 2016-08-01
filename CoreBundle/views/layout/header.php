<!doctype html>
<html lang="fr">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Capital Vision</title>

</head>

<body>

<?php

if (isset($_SESSION['username_mediastorage']) && isset($_SESSION['role_mediastorage'])) {
	echo 'Connecté en tant que ' . $_SESSION['username_mediastorage'];
}
else {
	echo 'Non connecté';
}

?>

<h1>MediaStorage</h1>