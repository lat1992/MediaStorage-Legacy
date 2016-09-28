<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class FolderPageController {

	private $_folderManager;
	private $_mediaManager;
	private $_designManager;
	private $_toolboxManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_mediaManager = new MediaManager();
		$this->_designManager = new DesignManager();
		$this->_toolboxManager = new ToolboxManager();

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

	public function folderPageAction() {

		if (isset($_GET['parent_id'])) {
			$folders = $this->_folderManager->getFolderByParentIdAndOrganizationIdDb($_GET['parent_id']);
			$programs = $this->_mediaManager->getAllProgramsByIdOrganizationAndFolderIdDb($_GET['parent_id']);
			$contents = $this->_mediaManager->getAllContentsByIdOrganizationAndFolderIdDb($_GET['parent_id']);

			$this->mergeErrorArray($folders);
			$this->mergeErrorArray($programs);
			$this->mergeErrorArray($contents);

			$contents = $this->_mediaManager->formatProgramPageContentForCard($contents);

			$title = $this->_folderManager->getFolderPathByFolderId($_GET['parent_id']);
			$title = $this->_folderManager->formatPathData($title);

		}
		else {
			$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();

			$title['title'] = FOLDER;
		}

		$this->mergeErrorArray($folders);

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/folder/folder.php');
	}
}