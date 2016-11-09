<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');


class FolderPageController {

	private $_folderManager;
	private $_mediaManager;
	private $_designManager;
	private $_toolboxManager;
	private $_mediaExtraManager;
	private $_languageManager;
	private $_mediaExtraFieldManager;
	private $_mediaInfoManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_mediaManager = new MediaManager();
		$this->_designManager = new DesignManager();
		$this->_toolboxManager = new ToolboxManager();
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

	public function folderPageAction() {

		if (isset($_GET['parent_id'])) {
			$folders = $this->_folderManager->getFolderByParentIdAndOrganizationIdDb($_GET['parent_id']);
			$programs = $this->_mediaManager->getAllProgramsByIdOrganizationAndFolderIdDb($_GET['parent_id']);
			$total_pages_program = $this->_mediaManager->getPageNumberForFolderViewDb($_GET['parent_id'], 1);

			$contents = $this->_mediaManager->getAllContentsByIdOrganizationAndFolderIdDb($_GET['parent_id']);
			$total_pages_content = $this->_mediaManager->getPageNumberForFolderViewDb($_GET['parent_id'], 2);

			$this->mergeErrorArray($folders);
			$this->mergeErrorArray($programs);
			$this->mergeErrorArray($contents);

			$contents = $this->_mediaManager->formatProgramPageContentForCard($contents);

			$title = $this->_folderManager->getFolderPathByFolderId($_GET['parent_id']);
			$title = $this->_folderManager->formatPathData($title);

			$total_pages = $this->_folderManager->getPageNumberForFolderViewDb($_GET['parent_id']);
			$this->_folderManager->setCurrentPage($current_page);

			$total_pages = max($total_pages, $total_pages_program, $total_pages_content);
		}
		else {
			$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();

			$title['title'] = FOLDER;

			$total_pages = $this->_folderManager->getPageNumberForFolderViewDb(null);
			$this->_folderManager->setCurrentPage($current_page);
		}
		$this->mergeErrorArray($folders);

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

		$media_extra_data_content = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
		$this->mergeErrorArray($media_extra_data_content);
		$media_extra_content = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data_content);


		include ('ClientBundle/views/folder/folder.php');
	}
}