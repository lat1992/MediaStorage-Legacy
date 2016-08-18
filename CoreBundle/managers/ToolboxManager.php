<?php

class ToolBoxManager {

	// private $_folderMediaModel;

	// public function __construct() {
	// 	$this->_folderMediaModel = new FolderMedia();
	// }
	public function mysqliResultToArray($mysqli_data) {

		$array_data = array();

		if ($mysqli_data && $mysqli_data['data']) {

			while ($mysqli_result = $mysqli_data['data']->fetch_assoc()) {
				$array_data[] = $mysqli_result;
			}

		}

		return $array_data;
	}
}