<?php

require_once('CoreBundle/managers/SharelistManager.php');
require_once('CoreBundle/managers/UserManager.php');

class SharelistController {

	private $_sharelistManager;
	private $_userManager;

	private $_errorArray;

	public function __construct() {
		$this->_sharelistManager = new SharelistManager();
		$this->_userManager = new UserManager();

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

	// public function listAction() {
	// 	$sharelists = $this->_sharelistManager->getAllSharelistsDb();

	// 	$this->mergeErrorArray($sharelists);

	// 	include ('CoreBundle/views/sharelist/sharelist_list.php');
	// }

	public function createAction() {
		$sharelist = array();

		if (isset($_POST['id_sharelist_create_mediastorage']) && (strcmp($_POST['id_sharelist_create_mediastorage'], '54843') == 0)) {
			$sharelist = $this->_sharelistManager->formatSharelistArrayWithPostData();
			$return_value['error'] = $this->_sharelistManager->sharelistCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_sharelistManager->sharelistCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$users = $this->_userManager->getAllUsersDb();

		$this->mergeErrorArray($users);

		include ('CoreBundle/views/sharelist/sharelist_create.php');
	}

	public function editAction() {
		$sharelist_data = $this->_sharelistManager->getSharelistByIdDb($_GET['sharelist_id']);
		$users = $this->_userManager->getAllUsersDb();

		$this->mergeErrorArray($sharelist_data);
		$this->mergeErrorArray($users);

		while ($sharelist_data_temp = $sharelist_data['data']->fetch_assoc()) {
			$sharelist = $sharelist_data_temp;
		}

		if (isset($_POST['id_sharelist_create_mediastorage']) && (strcmp($_POST['id_sharelist_create_mediastorage'], '54843') == 0)) {
			$return_value['error'] = $this->_sharelistManager->sharelistCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_sharelistManager->sharelistEditDb($sharelist);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/sharelist/sharelist_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['sharelist_id'])) {

			$return_value = $this->_sharelistManager->removeSharelistByIdDb($_GET['sharelist_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}