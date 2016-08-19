<?php

require_once('CoreBundle/models/MediaExtraFieldLanguage.php');

class MediaExtraFieldLanguageManager {

	private $_mediaExtraFieldLanguage;

	public function __construct() {
		$this->_mediaExtraFieldLanguage = new MediaExtraFieldLanguage();
	}

	public function mediaExtraFieldLanguageCreateDb() {
		return $this->_mediaExtraFieldLanguage->createNewMediaExtraFieldLanguage($_POST);
	}
}