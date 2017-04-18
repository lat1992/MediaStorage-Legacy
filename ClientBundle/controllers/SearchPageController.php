<?php

require_once('CoreBundle/managers/SearchManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class SearchPageController {

	private $_errorArray;
	private $_searchManager;
	private $_designManager;

	public function __construct() {
		$this->_searchManager = new SearchManager();
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

	public function searchPageAction() {
		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		if (isset($_GET['keyword']) && isset($_GET['filtre'])) {
			$result = $this->_searchManager->quickSearch($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);
			$this->mergeErrorArray($result);
			if (count($this->_errorArray) == 0) {
				while ($row = $result['data']->fetch_assoc())
					var_dump($row);
			}
		}
		else if (isset($_GET['keyword']) && isset($_GET['paginate'])) {
			$folder_result = $this->_searchManager->searchFolder($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$program_result = $this->_searchManager->searchMediaProgram($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$content_result = $this->_searchManager->searchMediaContent($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$this->mergeErrorArray($folder_result);
			$this->mergeErrorArray($program_result);
			$this->mergeErrorArray($content_result);
			if (count($this->_errorArray) == 0) {
				$folder_data = $folder_result['data'];
				$program_data = $program_result['data'];
				$content_data = $content_result['data'];
			}
		}
		$title['title'] = SEARCH;
		include ('ClientBundle/views/search/search.php');
	}

	public function ajaxRefreshLiveSearchAction() {
		$result = $this->_searchManager->liveSearch($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);
		$this->mergeErrorArray($result);
		if (count($this->_errorArray) == 0) {
			$rows = array();
			while ($row_tmp = $result['data']->fetch_assoc()) {
				$rows[] = $row_tmp;
			}
			if (isset($rows)) {
				echo json_encode($rows);
			}
		}
		echo '';
		return ;
	}

	public function advancedSearchPageAction() {
		$media_extra_field = $this->_searchManager->getFormInputsData();

		if (isset($_GET['validator'])) {
			var_dump($_GET);
			exit;
			// $result = $this->_searchManager->
		}
		// Get design data
		if (isset($_SESSION['id_platform_organization'])) {
			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
		}
		// Quicksearch ?
		if (isset($_GET['keyword']) && isset($_GET['filtre'])) {
			$result = $this->_searchManager->quickSearch($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);
			$this->mergeErrorArray($result);
			if (count($this->_errorArray) == 0) {
				while ($row = $result['data']->fetch_assoc())
					var_dump($row);
			}
		}
		else if (isset($_GET['keyword']) && isset($_GET['paginate'])) {
			$folder_result = $this->_searchManager->searchFolder($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$program_result = $this->_searchManager->searchMediaProgram($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$content_result = $this->_searchManager->searchMediaContent($_GET['keyword'], $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$this->mergeErrorArray($folder_result);
			$this->mergeErrorArray($program_result);
			$this->mergeErrorArray($content_result);
			if (count($this->_errorArray) == 0) {
				$folder_data = $folder_result['data'];
				$program_data = $program_result['data'];
				$content_data = $content_result['data'];
			}
		}
		$title['title'] = ADVANCED_SEARCH;
		include ('ClientBundle/views/search/advanced_search.php');
	}
}