<?php

require_once('Model.php');

class Chapter extends Model {

	public function __construct() {
		parent::__construct('chapter');
	}
	public function findAllChapters() {
		$data = $this->_mysqli->query('SELECT id, tc_in, tc_out, id_media ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllChapters: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewChapter($data) {
		$tc_in = $this->_mysqli->real_escape_string($data['tc_in_mediastorage']);
		$tc_out = $this->_mysqli->real_escape_string($data['tc_out_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(tc_in, tc_out, id_media)' .
			' VALUES ("'. $tc_in . '", "' . $tc_out . '", ' . $id_media . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewChapter: ' . $this->_mysqli->error : '',
		);
	}

	public function updateChapterWithId($data, $chapter_id) {
		$tc_in = $this->_mysqli->real_escape_string($data['tc_in_mediastorage']);
		$tc_out = $this->_mysqli->real_escape_string($data['tc_out_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_media = ' . $id_media . ', tc_in = "' . $tc_in . '", tc_out = "' . $tc_out . '"' .
			' WHERE id = ' . $chapter_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateChapterWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findChapterById($chapter_id) {
		$chapter_id = $this->_mysqli->real_escape_string($chapter_id);

		$data = $this->_mysqli->query('SELECT id, tc_in, tc_out, id_media' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $chapter_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findChapterById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteChapterById($chapter_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $chapter_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteChapterById: ' . $this->_mysqli->error : '',
		);
	}
}