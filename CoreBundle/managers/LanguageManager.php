<?php

require_once('/CoreBundle/models/Language.php');

class LanguageManager {

	private $_languageModel;

	public function __construct() {
		$this->_languageModel = new Language();
	}

	public function getLanguageCodeByIdDb($id) {
		$result = $this->_languageModel->findLanguageById($id);

		while ($row = $result->fetch_assoc()) {
			return $row['code'];
		}			
	}

	public function getAllLanguagesDb() {
		return $this->_languageModel->findAllLanguages();			
	}
}