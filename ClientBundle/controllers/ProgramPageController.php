<?php

require_once('CoreBundle/managers/MediaManager.php');

class ProgramPageController {

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

	public function programPageAction() {

		if (isset($_GET['media_id'])) {
			$contents = $this->_mediaManager->getAllContentsByIdOrganizationAndParentIdDb($_GET['media_id']);

			$this->mergeErrorArray($contents);
		}
		else {
			$programs = $this->_folderManager->getAllProgramsWithoutParentsByOrganizationDb();

			$this->mergeErrorArray($programs);
		}

		$title = PROGRAM;

		include ('ClientBundle/views/program/program.php');
	}
}