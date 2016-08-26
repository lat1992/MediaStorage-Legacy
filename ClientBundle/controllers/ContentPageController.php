<?php

require_once('CoreBundle/managers/MediaManager.php');

class ContentPageController {

	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
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

	public function contentPageAction() {

		if (isset($_GET['media_id'])) {
			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);
			$title = $this->_mediaManager->formatPathData($title);
		}
		else {
			$title = CONTENT;
		}

		include ('ClientBundle/views/content/content.php');
	}
}