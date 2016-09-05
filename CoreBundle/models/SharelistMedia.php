<?php

require_once('Model.php');

class SharelistMedia extends Model {

	public function __construct() {
		parent::__construct('sharelist_media');
	}

	public function findAllSharelistMedias() {
		$data = $this->_mysqli->query('SELECT id, id_sharelist, id_media ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllSharelistMedias: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllSharelistMediasByUserIdAndSharelistId($id_user, $id_sharelist, $id_language) {
		$id_sharelist = $this->_mysqli->real_escape_string($id_sharelist);
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT sharelist_media.id, id_sharelist, id_media, media_file.filename, IF ((SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate' .
			' FROM ' . $this->_table .
			' LEFT JOIN sharelist ON id_sharelist = sharelist.id' .
			' LEFT JOIN media_file ON id_media_file = media_file.id' .
			' LEFT JOIN media ON media_file.id = media.id' .
			' WHERE sharelist.id_user = ' . $id_user . ' AND id_sharelist = ' . $id_sharelist
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllSharelistMediasByUserIdAndSharelistId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllSharelistMediasByUserId($id_user, $id_language) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT sharelist_media.id, id_sharelist, id_media, media_file.filename, IF ((SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate' .
			' FROM ' . $this->_table .
			' LEFT JOIN media_file ON id_media_file = media_file.id' .
			' LEFT JOIN media ON media_file.id = media.id' .
			' WHERE sharelist_media.id_user = ' . $id_user . ' AND id_sharelist IS NULL'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllSharelistMediasByUserIdAndSharelistId: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewSharelistMedia($data) {
		$id_sharelist = $this->_mysqli->real_escape_string($data['id_sharelist_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_sharelist, id_media_file, id_user)' .
			' VALUES ('. $id_sharelist . ', ' . $id_media . ', ' . $id_user . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewSharelistMedia: ' . $this->_mysqli->error : '',
		);
	}

	public function updateSharelistMediaWithId($data, $sharelist_media_id) {
		$id_sharelist = $this->_mysqli->real_escape_string($data['id_sharelist_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_sharelist = ' . $id_sharelist .
			' WHERE id = ' . $sharelist_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateSharelistMediaWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findSharelistMediaById($sharelist_media_id) {
		$sharelist_media_id = $this->_mysqli->real_escape_string($sharelist_media_id);

		$data = $this->_mysqli->query('SELECT id, id_sharelist, id_media' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $sharelist_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findSharelistMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteSharelistMediaById($sharelist_media_id) {
		$sharelist_media_id = $this->_mysqli->real_escape_string($sharelist_media_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $sharelist_media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteSharelistMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteSharelistMediaBySharelistId($sharelist_id) {
		$sharelist_id = $this->_mysqli->real_escape_string($sharelist_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_sharelist = ' . $sharelist_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteSharelistMediaBySharelistId: ' . $this->_mysqli->error : '',
		);
	}
}