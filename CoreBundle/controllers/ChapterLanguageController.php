<?php

require_once('CoreBundle/managers/ChapterLanguageManager.php');
require_once('CoreBundle/managers/ChapterManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class ChapterLanguageController {

	private $_chapterLanguageManager;
	private $_chapterManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_chapterLanguageManager = new ChapterLanguageManager();
		$this->_chapterManager = new ChapterManager();
		$this->_languageManager = new LanguageManager();

		$this->_errorArray = array();
	}

	private function mergeErrorArray($errorArray) {
		if (!empty($errorArray['error'])) {
			if (!is_array($errorArray['error'])) {
				$data_array[] = $errorArray['error'];
			}
			else {
				$data_array = $errorArray['error'];
			}
			$this->_errorArray = array_merge ($this->_errorArray, $data_array);
		}
	}

	public function createAction() {
		$chapter = array();

		if (isset($_POST['id_chapter_language_create_mediastorage']) && (strcmp($_POST['id_chapter_language_create_mediastorage'], '12646') == 0)) {
			$chapter_language = $this->_chapterLanguageManager->formatChapterLanguageArrayWithPostData();
			$return_value['error'] = $this->_chapterLanguageManager->chapterLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_chapterLanguageManager->chapterLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$chapters = $this->_chapterManager->getAllChaptersDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($chapters);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/chapter/chapter_language_create.php');
	}

	public function editAction() {
		$chapter_language_data = $this->_chapterLanguageManager->getChapterLanguageByIdDb($_GET['chapter_language_id']);
		$chapters = $this->_chapterManager->getAllChaptersDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($chapter_language_data);
		$this->mergeErrorArray($chapters);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($chapter_language_data_temp = $chapter_language_data['data']->fetch_assoc()) {
				$chapter_language = $chapter_language_data_temp;
			}

			if (isset($_POST['id_chapter_language_create_mediastorage']) && (strcmp($_POST['id_chapter_language_create_mediastorage'], '12646') == 0)) {
				$return_value['error'] = $this->_chapterLanguageManager->chapterLanguageCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_chapterLanguageManager->chapterLanguageEditDb($chapter_language);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/chapter/chapter_language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['chapter_language_id'])) {

			$return_value = $this->_chapterLanguageManager->removeChapterLanguageByIdDb($_GET['chapter_language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}