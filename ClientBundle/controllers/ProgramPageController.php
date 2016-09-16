<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');

class ProgramPageController {

	private $_mediaManager;
	private $_toolboxManager;
	private $_designManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();

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

			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);

			$this->mergeErrorArray($title);

			$title = $this->_mediaManager->formatPathData($title);
		}
		else {
			$programs = $this->_mediaManager->getAllProgramsWithoutParentsByOrganizationDb();

			$this->mergeErrorArray($programs);

			$title = PROGRAM;
		}

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/program/program.php');
	}
}