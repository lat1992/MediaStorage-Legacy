<?php

require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/GroupManager.php');

class OrganizationController {

	private $_organizationManager;
	private $_groupManager;

	private $_errorArray;

	public function __construct() {
		$this->_organizationManager = new OrganizationManager();
		$this->_groupManager = new GroupManager();

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
	// 	$organizations = $this->_organizationManager->getAllOrganizationsDb();

	// 	$this->mergeErrorArray($organizations);

	// 	include ('CoreBundle/views/organization/organization_list.php');
	// }

	public function createAction() {
		$organization = array();

		if (isset($_POST['id_organization_create_mediastorage']) && (strcmp($_POST['id_organization_create_mediastorage'], '87463975') == 0)) {
			$organization = $this->_organizationManager->formatOrganizationArrayWithPostData();
			$return_value['error'] = $this->_organizationManager->organizationCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_organizationManager->organizationCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$groups = $this->_groupManager->getAllGroupsDb();

		$this->mergeErrorArray($groups);

		include ('CoreBundle/views/organization/organization_create.php');
	}

	public function editAction() {
		$organization_data = $this->_organizationManager->getOrganizationByIdDb($_GET['organization_id']);
		$groups = $this->_groupManager->getAllGroupsDb();

		$this->mergeErrorArray($organization_data);
		$this->mergeErrorArray($groups);

		if (count($this->_errorArray) == 0) {

			while ($organization_data_temp = $organization_data['data']->fetch_assoc()) {
				$organization = $organization_data_temp;
			}

			if (isset($_POST['id_organization_create_mediastorage']) && (strcmp($_POST['id_organization_create_mediastorage'], '87463975') == 0)) {
				$return_value['error'] = $this->_organizationManager->organizationCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_organizationManager->organizationEditDb($organization);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/organization/organization_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['organization_id'])) {

			$return_value = $this->_organizationManager->removeOrganizationByIdDb($_GET['organization_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}