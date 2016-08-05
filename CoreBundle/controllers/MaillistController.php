<?php

require_once('CoreBundle/managers/MaillistManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');

class MaillistController {

	private $_maillistManager;
	private $_organizationManager;

	private $_errorArray;

	public function __construct() {
		$this->_maillistManager = new MaillistManager();
		$this->_organizationManager = new OrganizationManager();

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
		$maillists = $this->_maillistManager->getAllMaillistsWithMaillistLanguageAndLanguageDb();

		$this->mergeErrorArray($maillists);

		include ('CoreBundle/views/maillist/maillist_list.php');
	}

	public function createAction() {
		$maillist = array();

		if (isset($_POST['id_maillist_create_mediastorage']) && (strcmp($_POST['id_maillist_create_mediastorage'], '984156') == 0)) {
			$maillist = $this->_maillistManager->formatMaillistArrayWithPostData();
			$return_value['error'] = $this->_maillistManager->maillistCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_maillistManager->maillistCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		include ('CoreBundle/views/maillist/maillist_create.php');
	}

	public function editAction() {
		$maillist_data = $this->_maillistManager->getMaillistByIdDb($_GET['maillist_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($maillist_data);
		$this->mergeErrorArray($organizations);

		if (count($this->_errorArray) == 0) {

			while ($maillist_data_temp = $maillist_data['data']->fetch_assoc()) {
				$maillist = $maillist_data_temp;
			}

			if (isset($_POST['id_maillist_create_mediastorage']) && (strcmp($_POST['id_maillist_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_maillistManager->maillistCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_maillistManager->maillistEditDb($maillist);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/maillist/maillist_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['maillist_id'])) {

			$return_value = $this->_maillistManager->removeMaillistByIdDb($_GET['maillist_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}