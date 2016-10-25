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

	public function createNewTag() {
		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '() VALUES ()' );

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewTag: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
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
		$tag_id = $this->_mysqli->real_escape_string($tag_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $tag_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteTagByMediaId($media_id) {
		$media_id = $this->_mysqli->real_escape_string($media_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_media = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteTagByMediaId: ' . $this->_mysqli->error : '',
		);
	}

	public function findTagWithData($tag) {
		$tag = $this->_mysqli->real_escape_string($tag);

		$data = $this->_mysqli->query('SELECT id_tag FROM tag_language WHERE data LIKE "' . $tag . '";'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchTagWithData: ' . $this->_mysqli->error : '',
		);
	}

	public function createTagLink($tag_id, $media_id) {
		$tag_id = $this->_mysqli->real_escape_string($tag_id);
		$media_id = $this->_mysqli->real_escape_string($media_id);

		$data = $this->_mysqli->query('INSERT INTO tag_media (id_tag, id_media)' .
			' VALUES ("'. $tag_id . '", ' . $media_id . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'CreateTagLink: ' . $this->_mysqli->error : '',
		);
	}

	public function findTagdByIdMediaAndIdLanguage($id_language, $id_media) {
		$id_language = $this->_mysqli->real_escape_string($id_language);
		$id_media = $this->_mysqli->real_escape_string($id_media);

		$data = $this->_mysqli->query('SELECT tag_media.id, data FROM tag_media' .
			' lEFT JOIN tag_language ON tag_language.id_tag = tag_media.id_tag' .
			' WHERE tag_media.id_media = ' . $id_media . ' AND tag_language.id_language = ' . $id_language . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'CreateTagLink: ' . $this->_mysqli->error : '',
		);
	}

	public function findTagdByIdMediaAndIdTag($id_tag, $id_media) {
		$id_tag = $this->_mysqli->real_escape_string($id_tag);
		$id_media = $this->_mysqli->real_escape_string($id_media);

		$data = $this->_mysqli->query('SELECT id FROM tag_media' .
			' WHERE id_media = ' . $id_media . ' AND id_tag = ' . $id_tag . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findTagdByIdMediaAndIdTag: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteRelationByIdTagMedia($id_tag) {
		$id_tag = $this->_mysqli->real_escape_string($id_tag);

		$data = $this->_mysqli->query('DELETE FROM tag_media ' .
			' WHERE id = ' . $id_tag . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteRelationByIdMediaAndIdTag: ' . $this->_mysqli->error : '',
		);
	}
}