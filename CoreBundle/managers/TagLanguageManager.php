<?php

require_once('CoreBundle/models/TagLanguage.php');

class TagLanguageManager {

	private $_tagLanguageModel;

	public function __construct() {
		$this->_tagLanguageModel = new TagLanguage();
	}

	public function formatTagLanguageArrayWithPostData() {
		$tag = array();

		$tag['data'] = $_POST['data_mediastorage'];
		$tag['id_tag'] = $_POST['id_tag_mediastorage'];
		$tag['id_language'] = $_POST['id_language_mediastorage'];

		return $tag;
	}

	public function tagLanguageCreateFormCheck() {
		$error_tag_language = array();

		if (strlen($_POST['data_mediastorage']) == 0) {
			$error_tag_language[] = EMPTY_DATA;
		}
		if (strlen($_POST['data_mediastorage']) > 100) {
			$error_tag_language[] = INVALID_DATA_TOO_LONG;
		}

		return $error_tag_language;
	}

	public function tagLanguageCreateDb() {
		return $this->_tagLanguageModel->createNewTagLanguage($_POST);
	}

	public function tagLanguageEditDb($tag_language_data) {
		return $this->_tagLanguageModel->updateTagLanguageWithId($_POST, $tag_language_data['id']);
	}

	public function getTagLanguageByIdDb($tag_language_id) {
		return $this->_tagLanguageModel->findTagLanguageById($tag_language_id);
	}

	public function removeTagLanguageByIdDb($tag_language_id) {
		return $this->_tagLanguageModel->deleteTagLanguageById($tag_language_id);
	}

	public function removeTagLanguageByTagIdDb($tag_id) {
		return $this->_tagLanguageModel->deleteTagLanguageByTagId($tag_id);
	}

	//public function removeTagLanguage
}

