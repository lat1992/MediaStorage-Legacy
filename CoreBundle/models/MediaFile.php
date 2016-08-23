<?php

require_once('Model.php');

class MediaFile extends Model {

	public function __construct() {
		parent::__construct('media_file');
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
			' VALUES ('. $id_media . ', ' . $type . ', ' . $filename . ', ' . $filepath . ', ' . $metadata . ', ' . $right_download . ', ' . $right_addtocart . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewFolder: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
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
}