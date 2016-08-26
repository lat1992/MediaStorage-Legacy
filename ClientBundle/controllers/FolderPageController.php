<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class FolderPageController {

	private $_folderManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
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

	public function folderPageAction() {

		if (isset($_GET['parent_id'])) {
			$folders = $this->_folderManager->getFolderByParentIdAndOrganizationIdDb($_GET['parent_id']);
			$programs = $this->_mediaManager->getAllProgramsByIdOrganizationAndFolderIdDb($_GET['parent_id']);

			$this->mergeErrorArray($programs);

			$title = $this->_folderManager->getFolderPathByFolderId($_GET['parent_id']);
			$title = $this->_folderManager->formatPathData($title);

		}
		else {
			$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();

			$title = FOLDER;
		}

		$this->mergeErrorArray($folders);


		include ('ClientBundle/views/folder/folder.php');
	}
}