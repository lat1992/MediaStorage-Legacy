<?php

require_once('CoreBundle/managers/LanguageManager.php');

class LanguageController {

	private $_languageManager;

	private $_errorArray;

	public function __construct() {
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

	// public function listAction() {
	// 	$languages = $this->_languageManager->getAllLanguagesWithLanguageLanguageAndLanguageDb();

	// 	$this->mergeErrorArray($languages);

	// 	include ('CoreBundle/views/language/language_list.php');
	// }

	public function createAction() {
		$language = array();

		if (isset($_POST['id_language_create_mediastorage']) && (strcmp($_POST['id_language_create_mediastorage'], '984156') == 0)) {
			$language = $this->_languageManager->formatLanguageArrayWithPostData();
			$return_value['error'] = $this->_languageManager->languageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_languageManager->languageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		include ('CoreBundle/views/language/language_create.php');
	}

	public function editAction() {
		$language_data = $this->_languageManager->getLanguageByIdDb($_GET['language_id']);

		$this->mergeErrorArray($language_data);

		if (count($this->_errorArray) == 0) {

			while ($language_data_temp = $language_data['data']->fetch_assoc()) {
				$language = $language_data_temp;
			}

			if (isset($_POST['id_language_create_mediastorage']) && (strcmp($_POST['id_language_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_languageManager->languageCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_languageManager->languageEditDb($language);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/language/language_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['language_id'])) {

			$return_value = $this->_languageManager->removeLanguageByIdDb($_GET['language_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}