<?php

require_once('CoreBundle/models/MediaExtraFieldLanguage.php');

class MediaExtraFieldLanguageManager {

	private $_mediaExtraFieldLanguage;

	public function __construct() {
		$this->_mediaExtraFieldLanguage = new MediaExtraFieldLanguage();
	}

	public function mediaExtraFieldLanguageCreateDb($id_field, $id_language, $value) {
		return $this->_mediaExtraFieldLanguage->createNewMediaExtraFieldLanguage($id_field, $id_language, $value);
	}

	public function mediaExtraFieldLanguageEditDb($id_field, $id_language, $value) {
		return $this->_mediaExtraFieldLanguage->updateOrInsertMediaExtraFieldLanguage($id_field, $id_language, $value);
	}

	public function getMediaExtraFieldLanguagesDb($id_field) {
		return $this->_mediaExtraFieldLanguage->findMediaExtraFieldLanguagesByIdField($id_field);
	}
}