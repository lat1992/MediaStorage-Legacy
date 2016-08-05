<?php

require_once('CoreBundle/models/ChapterLanguage.php');

class ChapterLanguageManager {

	private $_chapterLanguageModel;

	public function __construct() {
		$this->_chapterLanguageModel = new ChapterLanguage();
	}

	public function formatChapterLanguageArrayWithPostData() {
		$chapter = array();

		$chapter['data'] = $_POST['data_mediastorage'];
		$chapter['id_chapter'] = $_POST['id_chapter_mediastorage'];
		$chapter['id_language'] = $_POST['id_language_mediastorage'];

		return $chapter;
	}

	public function chapterLanguageCreateFormCheck() {
		$error_chapter_language = array();

		if (strlen($_POST['data_mediastorage']) == 0) {
			$error_chapter_language[] = EMPTY_DATA;
		}
		if (strlen($_POST['data_mediastorage']) > 100) {
			$error_chapter_language[] = INVALID_DATA_TOO_LONG;
		}

		return $error_chapter_language;
	}

	public function chapterLanguageCreateDb() {
		return $this->_chapterLanguageModel->createNewChapterLanguage($_POST);
	}

	public function chapterLanguageEditDb($chapter_language_data) {
		return $this->_chapterLanguageModel->updateChapterLanguageWithId($_POST, $chapter_language_data['id']);
	}

	public function getChapterLanguageByIdDb($chapter_language_id) {
		return $this->_chapterLanguageModel->findChapterLanguageById($chapter_language_id);
	}

	public function removeChapterLanguageByIdDb($chapter_language_id) {
		return $this->_chapterLanguageModel->deleteChapterLanguageById($chapter_language_id);
	}

	public function removeChapterLanguageByChapterIdDb($chapter_id) {
		return $this->_chapterLanguageModel->deleteChapterLanguageByChapterId($chapter_id);
	}
}

