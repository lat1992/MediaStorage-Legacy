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

	public function createNewSharelistMedia($data) {
		$id_sharelist = $this->_mysqli->real_escape_string($data['id_sharelist_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_sharelist, id_media)' .
			' VALUES ('. $id_sharelist . ', ' . $id_media . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewSharelistMedia: ' . $this->_mysqli->error : '',
		);
	}

	public function updateSharelistMediaWithId($data, $sharelist_media_id) {
		$id_sharelist = $this->_mysqli->real_escape_string($data['id_sharelist_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_sharelist = ' . $id_sharelist . ', id_media = ' . $id_media .
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
}