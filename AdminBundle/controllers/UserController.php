<?php

require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class UserController {

	private $_userManager;
	private $_designManager;
	private $_toolboxManager;

	private $_errorArray;

	public function __construct() {
		$this->_userManager = new UserManager();
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

	public function listAction() {
		$this->_toolboxManager->setLastPageInSession();

		$id_organization = $_SESSION['id_organization'];

		// Get table view data to send to view
		$this->_userManager->getTableDataForView($table_data, $id_organization);

		// Title
		$title['title'] = USER_LIST_TITLE;

		$total_pages = $this->_userManager->getPageNumberDb();
		$this->_userManager->setCurrentPage($current_page);

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		// Including the view to show
		include ('AdminBundle/views/user/user_list.php');
	}

	public function createAction() {
		$success_redirect_url = '?page=list_users_admin';

		// Check if submit button as been pressed and if the data are valid.
		$this->_userManager->checkFormDataAndValidityAndCreate($user, $errors, $success_redirect_url);

		$this->mergeErrorArray($errors);

		$this->_userManager->getCreateViewData($select_data);

		$title['title'] = USER_CREATION_TITLE;

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$this->_toolboxManager->getCancelUrl($cancel_url, '?page=list_users_admin');

		include ('AdminBundle/views/user/user_create.php');
	}

	public function editAction() {
		$success_redirect_url = '?page=list_users_admin';

		$this->_userManager->getUser($_GET['user_id'], $user);

		// Check if submit button as been pressed and if the data are valid.
		$this->_userManager->checkFormDataAndValidityAndEdit($user, $errors, $success_redirect_url);

		$this->mergeErrorArray($errors);

		$this->_userManager->getCreateViewData($select_data);

		$title['title'] = USER_EDIT_TITLE;

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$this->_toolboxManager->getCancelUrl($cancel_url, '?page=list_users_admin');

		include ('AdminBundle/views/user/user_create.php');

	}

	public function deleteAction() {
		$_SESSION['flash_message'] = 'Action non fonctionnelle pour le moment';
		header('Location:' . '?page=list_users_admin');
		exit;
	}
}