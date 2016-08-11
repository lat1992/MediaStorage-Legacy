<?php

require_once('CoreBundle/managers/RoleManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/PermitManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/RolePermitManager.php');
require_once('CoreBundle/managers/RoleLanguageManager.php');

class RoleController {

	private $_roleManager;
	private $_organizationManager;
	private $_permitManager;
	private $_languageManager;
	private $_rolePermitManager;
	private $_roleLanguageManager;

	private $_errorArray;

	public function __construct() {
		$this->_roleManager = new RoleManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_permitManager = new PermitManager();
		$this->_languageManager = new LanguageManager();
		$this->_rolePermitManager = new RolePermitManager();
		$this->_roleLanguageManager = new RoleLanguageManager();

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
		$roles = $this->_roleManager->getAllRolesDb();

		$this->mergeErrorArray($roles);

		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . ROLE . '</th>',
				'<th>' . NAME . '</th>',
				'<th>' . NB_PERMIT . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($role = $roles['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $role['id'] . '</td>',
					'<td>' . $role['role'] . '</td>',
					'<td>' . $role['name'] . '</td>',
					'<td>' . $role['permit_count'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_role_root&role_id=' . $role['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_role_root&role_id=' . $role['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = ROLE_LIST_TITLE;

		include ('RootBundle/views/role/role_list.php');
	}

	public function createAction() {
		$role = array();

		if (isset($_POST['id_role_create_mediastorage']) && (strcmp($_POST['id_role_create_mediastorage'], '984156') == 0)) {
			$role = $this->_roleManager->formatRoleArrayWithPostData();
			$return_value['error'] = $this->_roleManager->roleCreateFormCheck();
			$this->mergeErrorArray($return_value);
			$return_value['error'] = $this->_roleLanguageManager->roleLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_roleManager->roleCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_role_mediastorage'] = $return_value['id'];
					$return_value = $this->_rolePermitManager->rolePermitMultipleCreateDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$return_value = $this->_roleLanguageManager->roleLanguageCreateDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {
							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_role_root');
							exit;
						}
					}

				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$permits = $this->_permitManager->getAllPermitsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($permits);
		$this->mergeErrorArray($languages);

		include ('RootBundle/views/role/role_create.php');
	}

	public function editAction() {
		$role_data = $this->_roleManager->getRoleByIdDb($_GET['role_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$permits = $this->_permitManager->getAllPermitsDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($role_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($permits);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($role_data_temp = $role_data['data']->fetch_assoc()) {
				$role = $role_data_temp;
			}

			if (isset($_POST['id_role_create_mediastorage']) && (strcmp($_POST['id_role_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_roleManager->roleCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_roleManager->roleEditDb($role);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$_POST['id_role_mediastorage'] = $_GET['role_id'];
						$return_value = $this->_rolePermitManager->rolePermitMultipleUpdateByRoleIdDb($_GET['role_id']);
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {

							$return_value = $this->_roleLanguageManager->roleLanguageEditDb($role);
							$this->mergeErrorArray($return_value);

							if (count($this->_errorArray) == 0) {
								$_SESSION['flash_message'] = ACTION_SUCCESS;
								header('Location:' . '?page=list_role_root');
								exit;
							}
						}
					}
				}
			}

		}

		$selected_group_permit_data = $this->_rolePermitManager->getRolePermitByRoleIdDb($_GET['role_id']);

		$this->mergeErrorArray($selected_group_permit_data);

		$selected_group_permit = array();

		if (count($this->_errorArray) == 0) {
			while ($selected_group_permit_temp = $selected_group_permit_data['data']->fetch_assoc()) {
				$selected_group_permit[] = $selected_group_permit_temp['id_permit'];
			}
		}

		$title = ROLE_EDIT_TITLE;

		include ('RootBundle/views/role/role_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['role_id'])) {

			$return_value = $this->_roleManager->removeRoleByIdDb($_GET['role_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('RootBundle/views/common/error.php');
	}
}