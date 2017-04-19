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

		if (isset($_GET['keyword'])) {
			if (!isset($_GET['paginate']))
				$_GET['paginate'] = 1;
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

		/*if (isset($_GET['search'])) {
			var_dump($_GET);
			exit;
		}*/
		// Get design data
		if (isset($_SESSION['id_platform_organization'])) {
			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
		}

		if (isset($_GET['search'])) {
			$conds = array();
			if (isset($_GET['title']) && strcmp($_GET['title'], ''))
				$conds[] = 'memory_media_info.title LIKE "%'.$_GET['title'].'%"';
			if (isset($_GET['subtitle']) && strcmp($_GET['subtitle'],''))
				$conds[] = 'memory_media_info.subtitle LIKE "%'.$_GET['subtitle'].'%"';
			if (isset($_GET['description']) && strcmp($_GET['description'], ''))
				$conds[] = 'memory_media_info.description LIKE "%'.$_GET['description'].'%"';
			if (isset($_GET['chapter']) && strcmp($_GET['chapter'], ''))
				$conds[] = 'memory_chapter_language.data LIKE "%'.$_GET['chapter'].'%"';
			if (isset($_GET['reference']) && strcmp($_GET['reference'], ''))
				$conds[] = 'memory_media.reference_client LIKE "'.$_GET['reference'].'"';

			$condition = ' (';
			$i = 0;
			while (isset($conds[$i])) {
				$condition .= $conds[$i];
				if (isset($conds[$i + 1]))
					$condition .= ' AND ';
				else
					$condition .= ')';
				$i++;
			}
			echo $condition;
			exit;

			$condition = '(memory_folder_language.data LIKE "%'.$keyword.'%" AND memory_media_extra.data LIKE "%'.$keyword.'%" AND memory_media_extra_array.element LIKE "%'.$keyword.'%" AND memory_media_file.filename LIKE "%'.$keyword.'%"  AND memory_tag_language.data LIKE "%'.$keyword.'%")';
		}

		if (isset($condition)) {
			if (!isset($_GET['paginate']))
				$_GET['paginate'] = 1;
			$folder_result = $this->_searchManager->searchFolder($condition, $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$program_result = $this->_searchManager->searchMediaProgram($condition, $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
			$content_result = $this->_searchManager->searchMediaContent($condition, $_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage'], $_GET['paginate'], 10);
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