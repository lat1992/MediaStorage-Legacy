<?php

require_once('CoreBundle/managers/TagLanguageManager.php');
require_once('CoreBundle/managers/TagManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class TagLanguageController {

	private $_tagLanguageManager;
	private $_tagManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_tagLanguageManager = new TagLanguageManager();
		$this->_tagManager = new TagManager();
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
		$tag = array();

		if (isset($_POST['id_tag_language_create_mediastorage']) && (strcmp($_POST['id_tag_language_create_mediastorage'], '12646') == 0)) {
			$tag_language = $this->_tagLanguageManager->formatTagLanguageArrayWithPostData();
			$return_value['error'] = $this->_tagLanguageManager->tagLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_tagLanguageManager->tagLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$tags = $this->_tagManager->getAllTagsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($tags);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/tag/tag_language_create.php');
	}

	public function editAction() {
		$tag_language_data = $this->_tagLanguageManager->getTagLanguageByIdDb($_GET['tag_language_id']);
		$tags = $this->_tagManager->getAllTagsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($tag_language_data);
		$this->mergeErrorArray($tags);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($tag_language_data_temp = $tag_language_data['data']->fetch_assoc()) {
				$tag_language = $tag_language_data_temp;
			}

			if (isset($_POST['id_tag_language_create_mediastorage']) && (strcmp($_POST['id_tag_language_create_mediastorage'], '12646') == 0)) {
				$return_value['error'] = $this->_tagLanguageManager->tagLanguageCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_tagLanguageManager->tagLanguageEditDb($tag_language);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/tag/tag_language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['tag_language_id'])) {

			$return_value = $this->_tagLanguageManager->removeTagLanguageByIdDb($_GET['tag_language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}