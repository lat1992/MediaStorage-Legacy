<?php

require_once('Model.php');

class Tag extends Model {

	public function __construct() {
		parent::__construct('tag');
	}
	public function findAllTags() {
		$data = $this->_mysqli->query('SELECT id, tag, id_media ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllTags: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewTag($data) {
		$tag = $this->_mysqli->real_escape_string($data['tag_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(tag, id_media)' .
			' VALUES ("'. $tag . '", ' . $id_media . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewTag: ' . $this->_mysqli->error : '',
		);
	}

	public function updateTagWithId($data, $tag_id) {
		$tag = $this->_mysqli->real_escape_string($data['tag_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_media = ' . $id_media . ', tag = "' . $tag . '"' .
			' WHERE id = ' . $tag_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateTagWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findTagById($tag_id) {
		$tag_id = $this->_mysqli->real_escape_string($tag_id);

		$data = $this->_mysqli->query('SELECT id, tag, id_media' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $tag_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findTagById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteTagById($tag_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $tag_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteTagByMediaId($media_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_media = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagByMediaId: ' . $this->_mysqli->error : '',
		);
	}
}