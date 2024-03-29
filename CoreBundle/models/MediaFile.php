<?php

require_once('Model.php');

class MediaFile extends Model {

	public function __construct() {
		parent::__construct('media_file');
	}

	public function findAllMediaFiles() {
		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_preview' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFiles: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMediaFilesWithoutMediaId() {
		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_preview' .
			' FROM ' . $this->_table .
			' WHERE id_media IS NULL'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFilesWithoutMediaId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaFileById($id_media_file) {
		$data = $this->_mysqli->query('SELECT * FROM ' . $this->_table .
			' WHERE id = '. $id_media_file
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaFileById: ' . $this->_mysqli->error : '',
		);
	}

	public function createMediaFile($data, $id_organization) {
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$type = $this->_mysqli->real_escape_string($data['type_mediastorage']);
		$filename = $this->_mysqli->real_escape_string($data['filename_mediastorage']);
		$filepath = $this->_mysqli->real_escape_string($data['filepath_mediastorage']);
		$metadata = $this->_mysqli->real_escape_string($data['metadata_mediastorage']);
		$right_download = $this->_mysqli->real_escape_string($data['right_download_mediastorage']);
		$right_preview = $this->_mysqli->real_escape_string($data['right_preview_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_media, type, filename, filepath, metadata, right_download, right_preview, id_organization)' .
			' VALUES ('. $id_media . ', ' . $type . ', "' . $filename . '", "' . $filepath . '", ' . $metadata . ', ' . $right_download . ', ' . $right_preview . ', ' . $id_organization . ');'
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

		$data = $this->_mysqli->query('SELECT id, id_media, type, filename, filepath, right_download, right_preview, mime_type' .
			' FROM ' . $this->_table .
			' WHERE id_media = ' . $media_id
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaFilesByMediaId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaFileByMediaFileId($id_media_file) {
		$id_media_file = $this->_mysqli->real_escape_string($id_media_file);

		$data = $this->_mysqli->query('SELECT id, id_media, mine_type, filename, filepath, right_download, right_preview' .
			' FROM ' . $this->_table .
			' WHERE id = ' . $id_media_file
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaFileByMediaFileId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaFileByToken($token) {
		$token = $this->_mysqli->real_escape_string($token);

		$data = $this->_mysqli->query('SELECT media_file.id, media_file.id_media, media_file.mime_type, media_file.filename, media_file.filepath, media_file.metadata, media_file.right_download, media_file.right_preview' .
			' FROM ' . $this->_table .
			' LEFT JOIN user_download_token ON user_download_token.id_media_file = media_file.id'.
			' WHERE user_download_token.token LIKE "' . $token .'"'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaFileByMediaFileId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaFileByMediaId($media_id) { 
		$data = $this->_mysqli->query('DELETE FROM media_file WHERE id_media = '.$media_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'removeMediaFileByMediaId: ' . $this->_mysqli->error : '',
		);
	}
}