<?php

require_once('CoreBundle/managers/SearchManager.php');

class SearchPageController {

	private $_errorArray;
	private $_searchManager;

	public function __construct() {
		$this->_searchManager = new SearchManager();
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
		if (isset($_GET['keyword'])) {
			$result = $this->_searchManager->quickSearch($_GET['keyword'], $_SESSION['id_plateform_organization'], $_SESSION['id_language_mediastorage']);
			$this->mergeErrorArray($result);
			if (count($this->_errorArray) == 0) {
				while ($row = $result['data']->fetch_assoc())
					var_dump($row);
			}
		}
		include ('ClientBundle/views/search/search.php');
	}

	public function ajaxRefreshLiveSearchAction() {
		$result = $this->_searchManager->liveSearch($_GET['keyword'], $_SESSION['id_plateform_organization'], $_SESSION['id_language_mediastorage']);
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
}