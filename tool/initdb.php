<?php

	$setting = parse_ini_file('../config.ini.php', true);
	$mysqli = new mysqli($setting['database']['host'], $setting['database']['username'], $setting['database']['password'], $setting['database']['databasename']);
	$mysqli->set_charset('utf8');

	// chapter_language
	$mysqli->query('TRUNCATE TABLE memory_chapter_language');
	$result = $mysqli->query('SELECT id, id_chapter, id_language, data FROM chapter_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_chapter_language (id, id_chapter, id_language, data) VALUES ('. $row['id'] .', '. $row['id_chapter'] .', '. $row['id_language'] .', "'. $row['data'] .'");');
	}

	// folder_language
	$mysqli->query('TRUNCATE TABLE memory_folder_language');
	$result = $mysqli->query('SELECT id, id_folder, id_language, data, description FROM folder_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_folder_language (id, id_folder, id_language, data, description) VALUES ('. $row['id'] .', '. $row['id_folder'] .', '. $row['id_language'] .', "'. $row['data'] .'", "'. $row['description'] .'");');
	}

	// media
	$mysqli->query('TRUNCATE TABLE memory_media');
	$result = $mysqli->query('SELECT id, id_type, id_organization, reference, reference_client, right_view FROM media WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media (id, id_type, id_organization, reference, reference_client, right_view) VALUES ('. $row['id'] .', '. $row['id_type'] .', '. $row['id_organization'] .', "'. $row['reference'] .'", "'. $row['reference_client'] .'", '. $row['right_view'] .');');
	}

	// media_extra
	$mysqli->query('TRUNCATE TABLE memory_media_extra');
	$result = $mysqli->query('SELECT id, id_media, id_field, id_language, id_array, data FROM media_extra WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_extra (id, id_media, id_field, id_language, id_array, data) VALUES ('. $row['id'] .', '. $row['id_media'] .', '. $row['id_field'] .', '. $row['id_language'] .', '. $row['id_array'] .', "'. $row['data'] .'");');
	}

	// media_extra_array
	$mysqli->query('TRUNCATE TABLE memory_media_extra_array');
	$result = $mysqli->query('SELECT id, id_field, id_language, element FROM media_extra_array WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_extra_array (id, id_field, id_language, element) VALUES ('. $row['id'] .', '. $row['id_field'] .', '. $row['id_language'] .', "'. $row['element'] .'");');
	}

	// media_file
	$mysqli->query('TRUNCATE TABLE memory_media_file');
	$result = $mysqli->query('SELECT id, id_media, filename, right_download, right_addtocart FROM media_file WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_file (id, id_media, filename, right_download, right_addtocart) VALUES ('. $row['id'] .', '. $row['id_media'] .', "'. $row['filename'] .'", '. $row['right_download'] .', '. $row['right_addtocart'] .');');
	}

	// media_info
	$mysqli->query('TRUNCATE TABLE memory_media_info');
	$result = $mysqli->query('SELECT id, id_media, id_language, title, subtitle FROM media_info WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_info (id, id_media, id_language, title, subtitle) VALUES ('. $row['id'] .', '. $row['id_media'] .', '. $row['id_language'] .', "'. $row['title'] .'", "'. $row['subtitle'] .'");');
	}

	// tag_language
	$mysqli->query('TRUNCATE TABLE memory_tag_language');
	$result = $mysqli->query('SELECT id, id_tag, id_language, data FROM tag_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_tag_language (id, id_tag, id_language, data) VALUES ('. $row['id'] .', '. $row['id_tag'] .', '. $row['id_language'] .', "'. $row['data'] .'");');
	}

	$mysqli->close();
?>