<?php

require_once('CoreBundle/managers/ChapterManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class ChapterController {

	private $_chapterManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_chapterManager = new ChapterManager();
		$this->_mediaManager = new MediaManager();

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

	public function listAction() {
		$chapters = $this->_chapterManager->getAllChaptersWithChapterLanguageAndLanguageDb();

		$this->mergeErrorArray($chapters);

		include ('CoreBundle/views/chapter/chapter_list.php');
	}

	public function createAction() {
		$chapter = array();

		if (isset($_POST['id_chapter_create_mediastorage']) && (strcmp($_POST['id_chapter_create_mediastorage'], '984156') == 0)) {
			$chapter = $this->_chapterManager->formatChapterArrayWithPostData();
			$return_value['error'] = $this->_chapterManager->chapterCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_chapterManager->chapterCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$medias = $this->_mediaManager->getAllMediasDb();
		$this->mergeErrorArray($medias);

		include ('CoreBundle/views/chapter/chapter_create.php');
	}

	public function editAction() {
		$chapter_data = $this->_chapterManager->getChapterByIdDb($_GET['chapter_id']);
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($chapter_data);
		$this->mergeErrorArray($medias);

		if (count($this->_errorArray) == 0) {

			while ($chapter_data_temp = $chapter_data['data']->fetch_assoc()) {
				$chapter = $chapter_data_temp;
			}

			if (isset($_POST['id_chapter_create_mediastorage']) && (strcmp($_POST['id_chapter_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_chapterManager->chapterCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_chapterManager->chapterEditDb($chapter);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/chapter/chapter_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['chapter_id'])) {

			$return_value = $this->_chapterManager->removeChapterByIdDb($_GET['chapter_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}