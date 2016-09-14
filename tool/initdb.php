<?php

	$setting = parse_ini_file('../config.ini.php', true);
	$mysqli = new mysqli($setting['database']['host'], $setting['database']['username'], $setting['database']['password'], $setting['database']['databasename']);
	$mysqli->set_charset('utf8');

	// chapter_language
	$mysqli->query('TRUNCATE TABLE memory_chapter_language');
	$result = $mysqli->query('SELECT id, data FROM chapter_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_chapter_language (id, data) VALUES ('. $row['id'] .', "'. $row['data'] .'");');
	}

	// folder_language
	$mysqli->query('TRUNCATE TABLE memory_folder_language');
	$result = $mysqli->query('SELECT id, data, description FROM folder_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_folder_language (id, data, description) VALUES ('. $row['id'] .', "'. $row['data'] .'", "'. $row['description'] .'");');
	}

	// media
	$mysqli->query('TRUNCATE TABLE memory_media');
	$result = $mysqli->query('SELECT id, reference, reference_client FROM media WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media (id, reference, reference_client) VALUES ('. $row['id'] .', "'. $row['reference'] .'", "'. $row['reference_client'] .'");');
	}

	// media_extra
	$mysqli->query('TRUNCATE TABLE memory_media_extra');
	$result = $mysqli->query('SELECT id, data FROM media_extra WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_extra (id, data) VALUES ('. $row['id'] .', "'. $row['data'] .'");');
	}

	// media_extra_array
	$mysqli->query('TRUNCATE TABLE memory_media_extra_array');
	$result = $mysqli->query('SELECT id, element FROM media_extra_array WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_extra_array (id, element) VALUES ('. $row['id'] .', "'. $row['element'] .'");');
	}

	// media_extra_field_language
	$mysqli->query('TRUNCATE TABLE memory_media_extra_field_language');
	$result = $mysqli->query('SELECT id, data FROM media_extra_field_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_extra_field_language (id, data) VALUES ('. $row['id'] .', "'. $row['data'] .'");');
	}

	// media_file
	$mysqli->query('TRUNCATE TABLE memory_media_file');
	$result = $mysqli->query('SELECT id, filename FROM media_file WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_file (id, filename) VALUES ('. $row['id'] .', "'. $row['filename'] .'");');
	}

	// media_info
	$mysqli->query('TRUNCATE TABLE memory_media_info');
	$result = $mysqli->query('SELECT id, title, subtitle FROM media_info WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_media_info (id, title, subtitle, episode_number, image_version, sound_version) VALUES ('. $row['id'] .', "'. $row['title'] .'", "'. $row['subtitle'] .'");');
	}

	// tag
	$mysqli->query('TRUNCATE TABLE memory_tag');
	$result = $mysqli->query('SELECT id, tag FROM tag WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_tag (id, tag) VALUES ('. $row['id'] .', "'. $row['tag'] .'");');
	}

	// tag_language
	$mysqli->query('TRUNCATE TABLE memory_tag_language');
	$result = $mysqli->query('SELECT id, data FROM tag_language WHERE 1;');
	while ($row = $result->fetch_assoc()) {
		$mysqli->query('INSERT INTO memory_tag_language (id, data) VALUES ('. $row['id'] .', "'. $row['data'] .'");');
	}

	$mysqli->close();
?>