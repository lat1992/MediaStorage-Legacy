<?php

require_once('CoreBundle/models/Media.php');

class MediaManager {

	private $_mediaModel;

	public function __construct() {
		$this->_mediaModel = new Media();
	}

	public function getAllMediasDb() {
		return $this->_mediaModel->findAllMedias();
	}
}