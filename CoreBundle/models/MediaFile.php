<?php

require_once('Model.php');

class MediaFile extends Model {

	public function __construct() {
		parent::__construct('media_file');
	}

	public function findAllMediaFiles() {
		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_addtocart' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFiles: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMediaFilesWithoutMediaId() {
		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_addtocart' .
			' FROM ' . $this->_table .
			' WHERE id_media IS NULL'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFilesWithoutMediaId: ' . $this->_mysqli->error : '',
		);
	}

	public function createMediaFile($data) {
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$filename = $this->_mysqli->real_escape_string($data['filename_mediastorage']);
		$filepath = $this->_mysqli->real_escape_string($data['filepath_mediastorage']);
		$metadata = $this->_mysqli->real_escape_string($data['metadata_mediastorage']);
		$right_download = $this->_mysqli->real_escape_string($data['right_download_mediastorage']);
		$right_addtocart = $this->_mysqli->real_escape_string($data['right_addtocart_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_media, type, filename, filepath, metadata, right_download, right_addtocart)' .
			' VALUES ('. $id_media . ', ' . $type . ', "' . $filename . '", "' . $filepath . '", ' . $metadata . ', ' . $right_download . ', ' . $right_addtocart . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createMediaFile: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
		);
	}

	public function updateMediaFileMediaId($media_file_id, $media_id) {
		$media_id = $this->_mysqli->real_escape_string($media_id);
		$media_file_id = $this->_mysqli->real_escape_string($media_file_id);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
		' SET id_media = ' . $media_id .
			' WHERE id = ' . $media_file_id . ';'
		);

	}

	public function findEnumOfType() {
		 $data = $this->_mysqli->query('SHOW COLUMNS' .
		 	' FROM ' . $this->_table .
			' LIKE "type"'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findEnumOfType: ' . $this->_mysqli->error : ''
		);
	}

	public function findAllMediaFilesByMediaId($media_id) {
		$media_id = $this->_mysqli->real_escape_string($media_id);

		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_addtocart' .
			' FROM ' . $this->_table .
			' WHERE id_media = ' . $media_id
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFilesByMediaId: ' . $this->_mysqli->error : '',
		);
	}


}