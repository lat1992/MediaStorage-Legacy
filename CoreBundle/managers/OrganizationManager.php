<?php

require_once('CoreBundle/models/Organization.php');

class OrganizationManager {

	private $_organizationModel;

	public function __construct() {
		$this->_organizationModel = new Organization();
	}

	public function getAllOrganizationsDb() {
		return $this->_organizationModel->findAllOrganizations();
	}

	public function formatOrganizationArrayWithPostData() {
		$organization = array();

		$organization['reference'] = $_POST['reference_mediastorage'];
		$organization['name'] = $_POST['name_mediastorage'];
		if (isset($_POST['id_group_mediastorage']))
			$organization['id_group'] = $_POST['id_group_mediastorage'];

		return $organization;
	}

	public function organizationCreateFormCheck() {
		$error_organization = array();

		if (strlen($_POST['reference_mediastorage']) == 0) {
			$error_organization[] = EMPTY_REFERENCE;
		}
		if (strlen($_POST['reference_mediastorage']) > 10) {
			$error_organization[] = INVALID_REFERENCE_TOO_LONG;
		}

		if (strlen($_POST['name_mediastorage']) == 0) {
			$error_organization[] = EMPTY_NAME;
		}
		if (strlen($_POST['name_mediastorage']) > 50) {
			$error_organization[] = INVALID_NAME_TOO_LONG;
		}

		return $error_organization;
	}

	public function organizationCreateDb() {
		$return_value = $this->_organizationModel->findOrganizationByReference($_POST['reference_mediastorage']);

		if ($return_value['data']->num_rows != 0) {
			return array(
				'data' => false,
				'error' => DUPLICATE_REFERENCE,
			);
		}
		if (!empty($return_value['error'])) {
			return $return_value;
		}

		return $this->_organizationModel->createNewOrganization($_POST);
	}

	public function getOrganizationByIdDb($organization_id) {
		return $this->_organizationModel->findOrganizationById($organization_id);
	}

	public function organizationEditDb($organization_data) {

		if (strcmp($group_data['reference'], $_POST['reference_mediastorage']) != 0) {

			$return_value = $this->_organizationModel->findOrganizationByReference($_POST['reference_mediastorage']);

			if ($return_value['data']->num_rows != 0) {
				return array(
					'data' => false,
					'error' => DUPLICATE_REFERENCE,
				);
			}
			if (!empty($return_value['error'])) {
				return $return_value;
			}

		}

		return $this->_organizationModel->updateOrganizationWithId($_POST, $organization_data['id']);
	}

	public function removeOrganizationByIdDb($organization_id) {
		return $this->_organizationModel->deleteOrganizationById($organization_id);
	}
}