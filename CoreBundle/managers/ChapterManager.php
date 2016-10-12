<?php

require_once('CoreBundle/models/Chapter.php');
require_once('CoreBundle/managers/ChapterLanguageManager.php');

class ChapterManager {

	private $_chapterModel;

	public function __construct() {
		$this->_chapterModel = new Chapter();
	}

	public function getAllChaptersWithChapterLanguageAndLanguageDb() {
		return $this->_chapterModel->findAllChaptersWithChapterLanguageAndLanguage();
	}

	public function getAllChaptersDb() {
		return $this->_chapterModel->findAllChapters();
	}

	public function formatChapterArrayWithPostData() {
		$chapter = array();

		$chapter['tc_in'] = $_POST['tc_in_mediastorage'];
		$chapter['tc_out'] = $_POST['tc_out_mediastorage'];
		$chapter['id_media'] = $_POST['id_media_mediastorage'];

		return $chapter;
	}

	public function chapterCreateFormCheck() {
		$error_chapter = array();

		return $error_chapter;
	}

	public function chapterCreateDb() {
		return $this->_chapterModel->createNewChapter($_POST);
	}

	public function getChapterByIdDb($chapter_id) {
		return $this->_chapterModel->findChapterById($chapter_id);
	}

	public function chapterEditDb($chapter_data) {
		return $this->_chapterModel->updateChapterWithId($_POST, $chapter_data['id']);
	}

	public function removeChapterByIdDb($chapter_id) {
		$_chapterLanguageManager = new ChapterLanguageManager();
		$_chapterLanguageModel->removeChapterLanguageByChapterIdDb($chapter_id);
		return $this->_chapterModel->deleteChapterById($chapter_id);
	}
}