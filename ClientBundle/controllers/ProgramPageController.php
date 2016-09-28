<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');


class ProgramPageController {

	private $_mediaManager;
	private $_toolboxManager;
	private $_designManager;
	private $_mediaExtraManager;
	private $_languageManager;
	private $_mediaExtraFieldManager;
	private $_mediaInfoManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();
		$this->_mediaExtraManager = new MediaExtraManager();
		$this->_languageManager = new LanguageManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		$this->_mediaInfoManager = new MediaInfoManager();

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
			$contents = $this->_mediaManager->formatProgramPageContentForCard($contents);

			$program = $this->_mediaManager->getMediaByIdAndOrganizationIdDb($_GET['media_id']);

			$this->mergeErrorArray($program);
			$program_data = $program['data']->fetch_assoc();

			$program_info = $this->_mediaInfoManager->getMediaInfoByMediaIdAndLanguageIdDb($_GET['media_id'], $_SESSION['id_language_mediastorage']);
			$this->mergeErrorArray($program_info);
			$program_info_data = $program_info['data']->fetch_assoc();


			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);

			$this->mergeErrorArray($title);

			$title = $this->_mediaManager->formatPathData($title);
		}
		else {
			$programs = $this->_mediaManager->getAllProgramsWithoutParentsByOrganizationDb();

			$this->mergeErrorArray($programs);

			$title['title'] = PROGRAM;
		}

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(1);
		$this->mergeErrorArray($media_extra_data);
		$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

		$languages_data = $this->_languageManager->getAllLanguagesByGroupDb();
		$this->mergeErrorArray($languages_data);
		$languages = $this->_toolboxManager->mysqliResultToArray($languages_data);

		include ('ClientBundle/views/program/program.php');
	}
}