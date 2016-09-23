<?php

require_once('Model.php');

class InitModel extends Model {

	public function __construct() {
		parent::__construct('init');
	}

	public function initChapterLanguage() {
		$this->_mysqli->query('TRUNCATE TABLE memory_chapter_language');
		$result = $this->_mysqli->query('SELECT id, id_chapter, id_language, data FROM chapter_language WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_chapter_language (id, id_chapter, id_language, data) VALUES ('. $row['id'] .', '. $row['id_chapter'] .', '. $row['id_language'] .', "'. $row['data'] .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initChapterLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function initFolderLanguage() {
		$this->_mysqli->query('TRUNCATE TABLE memory_folder_language');
		$result = $this->_mysqli->query('SELECT id, id_folder, id_language, data, description FROM folder_language WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_folder_language (id, id_folder, id_language, data, description) VALUES ('. $row['id'] .', '. $row['id_folder'] .', '. $row['id_language'] .', "'. $row['data'] .'", "'. $row['description'] .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initFolderLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function initMedia() {
		$this->_mysqli->query('TRUNCATE TABLE memory_media');
		$result = $this->_mysqli->query('SELECT id, id_type, id_folder, id_organization, reference, reference_client, right_view FROM media WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_media (id, id_type, id_folder, id_organization, reference, reference_client, right_view) VALUES ('. $row['id'] .', '. $row['id_type'] .', '. ($row['id_folder'] ? $row['id_folder'] : 'NULL') .', '. $row['id_organization'] .', "'. $row['reference'] .'", '. ($row['reference_client'] ? '"'. $row['reference_client'] .'"' : 'NULL') .', '. $row['right_view'] .');');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initMedia: ' . $this->_mysqli->error : '',
		);
	}

	public function initMediaExtra() {
		$this->_mysqli->query('TRUNCATE TABLE memory_media_extra');
		$result = $this->_mysqli->query('SELECT id, id_media, id_field, id_language, id_array, data FROM media_extra WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_media_extra (id, id_media, id_field, id_language, id_array, data) VALUES ('. $row['id'] .', '. $row['id_media'] .', '. $row['id_field'] .', '. ($row['id_language'] ? $row['id_language'] : 'NULL') .', '. ($row['id_array'] ? $row['id_array'] : 'NULL') .', '. ($row['data'] ? '"'. $row['data'] .'"' : 'NULL') .');');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initMediaExtra: ' . $this->_mysqli->error : '',
		);
	}

	public function initMediaExtraArray() {
		$this->_mysqli->query('TRUNCATE TABLE memory_media_extra_array');
		$result = $this->_mysqli->query('SELECT id, id_field, id_language, element FROM media_extra_array WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_media_extra_array (id, id_field, id_language, element) VALUES ('. $row['id'] .', '. $row['id_field'] .', '. $row['id_language'] .', "'. $row['element'] .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initMediaExtraArray: ' . $this->_mysqli->error : '',
		);
	}

	public function initMediaFile() {
		$this->_mysqli->query('TRUNCATE TABLE memory_media_file');
		$result = $this->_mysqli->query('SELECT id, id_media, filename, right_download, right_preview FROM media_file WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_media_file (id, id_media, filename, right_download, right_preview) VALUES ('. $row['id'] .', '. $row['id_media'] .', "'. $row['filename'] .'", '. $row['right_download'] .', '. $row['right_preview'] .');');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initMediaFile: ' . $this->_mysqli->error : '',
		);
	}

	public function initMediaInfo() {
		$this->_mysqli->query('TRUNCATE TABLE memory_media_info');
		$result = $this->_mysqli->query('SELECT id, id_media, id_language, title, subtitle FROM media_info WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_media_info (id, id_media, id_language, title, subtitle) VALUES ('. $row['id'] .', '. $row['id_media'] .', '. $row['id_language'] .', "'. $row['title'] .'", "'. $row['subtitle'] .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initMediaInfo: ' . $this->_mysqli->error : '',
		);
	}

	public function initTag() {
		$this->_mysqli->query('TRUNCATE TABLE memory_tag_language');
		$result = $this->_mysqli->query('SELECT id, id_tag, id_language, data FROM tag_language WHERE 1;');
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $this->_mysqli->query('INSERT INTO memory_tag_language (id, id_tag, id_language, data) VALUES ('. $row['id'] .', '. $row['id_tag'] .', '. $row['id_language'] .', "'. $row['data'] .'");');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'initTag: ' . $this->_mysqli->error : '',
		);
	}
}