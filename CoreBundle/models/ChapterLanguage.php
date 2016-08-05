<?php

require_once('Model.php');

class ChapterLanguage extends Model {

	public function __construct() {
		parent::__construct('chapter_language');
	}

	public function createNewChapterLanguage($data) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_chapter = $this->_mysqli->real_escape_string($data['id_chapter_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(data, id_chapter, id_language)' .
			' VALUES ("'. $data_media . '", ' . $id_chapter . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewChapterLanguage: ' . $this->_mysqli->error : '',
		);
	}

	public function updateChapterLanguageWithId($data, $chapter_language_id) {
		$data_media = $this->_mysqli->real_escape_string($data['data_mediastorage']);
		$id_chapter = $this->_mysqli->real_escape_string($data['id_chapter_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_chapter = ' . $id_chapter . ', data = "' . $data_media . '", id_language = ' . $id_language.
			' WHERE id = ' . $chapter_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateChapterLanguageWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findChapterLanguageById($chapter_language_id) {
		$chapter_language_id = $this->_mysqli->real_escape_string($chapter_language_id);

		$data = $this->_mysqli->query('SELECT id, data, id_chapter, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $chapter_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findChapterLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteChapterLanguageById($chapter_language_id) {
		$chapter_language_id = $this->_mysqli->real_escape_string($chapter_language_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $chapter_language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteChapterLanguageById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteChapterLanguageByChapterId($chapter_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_chapter = ' . $chapter_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteChapterLanguageByChapterId: ' . $this->_mysqli->error : '',
		);
	}
}