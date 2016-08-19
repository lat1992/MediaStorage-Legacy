<?php

require_once('CoreBundle/models/MediaExtraFieldLanguage.php');

class MediaExtraFieldLanguageManager {

	private $_mediaExtraFieldLanguage;

	public function __construct() {
		$this->_mediaExtraFieldLanguage = new MediaExtraFieldLanguage();
	}

	public function mediaExtraFieldLanguageCreateDb($id_field, $key, $value) {
		return $this->_mediaExtraFieldLanguage->createNewMediaExtraFieldLanguage($id_field, $key, $value);
	}
}