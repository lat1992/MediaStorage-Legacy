<?php

class DashboardController {

	private $_errorArray;

	public function __construct() {
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

	public function showAction() {
		include ('RootBundle/views/dashboard/dashboard.php');
	}

}
