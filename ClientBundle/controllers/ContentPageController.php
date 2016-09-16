<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');

class ContentPageController {

	private $_mediaManager;
	private $_mediaInfoManager;
	private $_mediaFileManager;
	private $_mediaExtraManager;
	private $_mediaExtraFieldManager;
	private $_toolboxManager;
	private $_designManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaFileManager = new MediaFileManager();
		$this->_mediaExtraManager = new MediaExtraManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
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

	public function listContentAction() {

		$contents = $this->_mediaManager->getAllContentsByIdOrganizationDb();

		$this->mergeErrorArray($contents);

		$title = CONTENT;

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/program/program.php');

	}

	public function contentPageAction() {

		if (isset($_GET['media_id'])) {
			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);
			$title = $this->_mediaManager->formatPathData($title);

			$media_infos_data = $this->_mediaInfoManager->getMediaInfoByMediaIdAndLanguageIdDb($_GET['media_id'], $_SESSION['id_language_mediastorage']);
			$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
			$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($_GET['media_id']);
			$media_files_data = $this->_mediaFileManager->getAllMediaFilesByMediaIdDb($_GET['media_id']);

			$this->mergeErrorArray($media_infos_data);
			$this->mergeErrorArray($media_extra_data);
			$this->mergeErrorArray($media_extras_user_data);
			$this->mergeErrorArray($media_files_data);

			$media_infos = $this->_toolboxManager->mysqliResultToArray($media_infos_data);
			$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
			$media_files = $this->_toolboxManager->mysqliResultToArray($media_files_data);

			$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

			$media_infos = $this->_mediaInfoManager->getArrayWithIdLanguageKey($media_infos);
		}
		else {
			$title = CONTENT;
		}

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/content/content.php');
	}
}