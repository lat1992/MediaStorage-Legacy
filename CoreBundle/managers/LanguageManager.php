<?php

require_once('CoreBundle/models/Language.php');

class LanguageManager {

	private $_languageModel;

	public function __construct() {
		$this->_languageModel = new Language();
	}

	public function getLanguageCodeByIdDb($id) {
		$result = $this->_languageModel->findLanguageById($id);

		while ($row = $result['data']->fetch_assoc()) {
			return $row['code'];
		}
	}

	public function getAllLanguagesDb() {
		return $this->_languageModel->findAllLanguages();
	}

	public function getAllLanguagesByGroupDb() {
		return $this->_languageModel->findAllLanguagesByGroup($_SESSION['id_group']);
	}


	public function formatLanguageArrayWithPostData() {
		$language = array();

		$language['name'] = $_POST['name_mediastorage'];
		$language['code'] = $_POST['code_mediastorage'];

		return $language;
	}

	public function languageCreateFormCheck() {
		$error_language = array();

		if (strlen($_POST['name_mediastorage']) == 0) {
			$error_language[] = EMPTY_NAME;
		}
		if (strlen($_POST['name_mediastorage']) > 30) {
			$error_language[] = INVALID_NAME_TOO_LONG;
		}
		if (strlen($_POST['code_mediastorage']) == 0) {
			$error_language[] = EMPTY_CODE;
		}
		if (strlen($_POST['code_mediastorage']) > 5) {
			$error_language[] = INVALID_CODE_TOO_LONG;
		}

		return $error_language;
	}

	public function languageCreateDb() {
		return $this->_languageModel->createNewLanguage($_POST);
	}

	public function getLanguageByIdDb($language_id) {
		return $this->_languageModel->findLanguageById($language_id);
	}

	public function languageEditDb($language_data) {
		return $this->_languageModel->updateLanguageWithId($_POST, $language_data['id']);
	}

	public function removeLanguageByIdDb($language_id) {
		return $this->_languageModel->deleteLanguageById($language_id);
	}

}