<?php

require_once('CoreBundle/models/User.php');
require_once('CoreBundle/models/UserInfo.php');

require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/RolePermitManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/RoleManager.php');

class UserManager {

	private $_userModel;
	private $_userInfoModel;

	private $_languageManager;
	private $_rolePermitManager;
	private $_toolboxManager;
	private $_roleManager;

	private $_rowNbPerPages = 5;

	public function __construct() {
		$this->_userModel = new User();
		$this->_userInfoModel = new UserInfo();

		$this->_languageManager = new LanguageManager();
		$this->_rolePermitManager = new RolePermitManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_roleManager = new RoleManager();
	}

	public function loginDb() {
		$result = $this->_userModel->findUserByUsernameAndPassword($_POST['username_mediastorage'], $_POST['password_mediastorage'], $_SESSION['id_platform_organization']);

		if (empty($result['error'])) {
			$_SESSION['username_mediastorage'] = $result['data']['username'];
			$_SESSION['user_id_mediastorage'] = $result['data']['id'];
			$_SESSION['role_mediastorage'] = $result['data']['id_role'];
			$_SESSION['language_mediastorage'] = $this->_languageManager->getLanguageCodeByIdDb($result['data']['id_language']);
			$_SESSION['id_language_mediastorage'] = $result['data']['id_language'];
			$_SESSION['id_organization'] = $result['data']['id_organization'];
			$_SESSION['id_group'] = $result['data']['id_group'];

			$return_value = $this->_rolePermitManager->getRolePermitByRoleIdDb($_SESSION['role_mediastorage']);

			if (empty($return_value['error'])) {
				while ($data = $return_value['data']->fetch_assoc()) {
					$_SESSION['permits'][$data['id_permit']] = $data['id_permit'];
				}
			}

	 		return array(
	 			'data' => true,
	 			'error' => $result['data']['error'],
	 		);
 		}

 		return array(
 			'data' => false,
 			'error' => $result['error'],
	 	);
	}

	public function formatUserArrayWithPostData() {
		$user = array();

		$user['username'] = $_POST['username_mediastorage'];
		$user['id_organization'] = $_POST['id_organization_mediastorage'];
		$user['id_role'] = $_POST['id_role_mediastorage'];
		$user['id_language'] = $_POST['id_language_mediastorage'];
		$user['first_name'] = $_POST['first_name_mediastorage'];
		$user['last_name'] = $_POST['last_name_mediastorage'];
		$user['company'] = $_POST['company_mediastorage'];
		$user['job'] = $_POST['job_mediastorage'];
		$user['email'] = $_POST['email_mediastorage'];
		$user['address'] = $_POST['address_mediastorage'];
		$user['zipcode'] = $_POST['zipcode_mediastorage'];
		$user['city'] = $_POST['city_mediastorage'];
		$user['country'] = $_POST['country_mediastorage'];
		$user['phone'] = $_POST['phone_mediastorage'];
		$user['mobile'] = $_POST['mobile_mediastorage'];

		return $user;
	}

	public function userCreateFormCheck() {
		$errors_user_create = array();

		if (strlen($_POST['username_mediastorage']) == 0) {
			$errors_user_create[] = EMPTY_USERNAME;
		}
		if (strlen($_POST['username_mediastorage']) > 20) {
			$errors_user_create[] = INVALID_USERNAME_TOO_LONG;
		}
		if (strlen($_POST['password_mediastorage']) == 0) {
			$errors_user_create[] = EMPTY_PASSWORD;
		}
		if (strcmp($_POST['password_mediastorage'], $_POST['password_mediastorage_bis']) != 0) {
			$errors_user_create[] = PASSWORD_NOT_MATCH;
		}
		if (strlen($_POST['first_name_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_FIRST_NAME_TOO_LONG;
		}
		if (strlen($_POST['last_name_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_LAST_NAME_TOO_LONG;
		}
		if (strlen($_POST['address_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_ADDRESS_TOO_LONG;
		}
		if (strlen($_POST['zipcode_mediastorage']) > 8) {
			$errors_user_create[] = INVALID_ZIPCODE_TOO_LONG;
		}
		if (strlen($_POST['city_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_CITY_TOO_LONG;
		}
		if (strlen($_POST['country_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_COUNTRY_TOO_LONG;
		}
		if (strlen($_POST['phone_mediastorage']) > 12) {
			$errors_user_create[] = INVALID_PHONE_TOO_LONG;
		}
		if (strlen($_POST['mobile_mediastorage']) > 12) {
			$errors_user_create[] = INVALID_MOBILE_TOO_LONG;
		}
		if (strlen($_POST['company_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_COMPANY_TOO_LONG;
		}
		if (strlen($_POST['job_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_JOB_TOO_LONG;
		}

		return $errors_user_create;
	}

	public function userCreateDb() {
		$return_value = $this->_userModel->findUserByUsernameAndIdOrganization($_POST['username_mediastorage'], $_POST['id_organization_mediastorage']);

		if ($return_value['data']->num_rows != 0) {
			return array(
				'data' => false,
				'error' => DUPLICATE_USERNAME,
			);
		}
		if (!empty($return_value['error'])) {
			return $return_value;
		}

		return $this->_userModel->createNewUser($_POST);
	}

	public function userEditAsAdminDb($user_data) {
		if (strcmp($user_data['username'], $_POST['username_mediastorage']) != 0) {

			$return_value = $this->_userModel->findUserByUsernameAndIdOrganization($_POST['username_mediastorage'], $_POST['id_organization_mediastorage']);

			if ($return_value['data']->num_rows != 0) {
				return array(
					'data' => false,
					'error' => DUPLICATE_USERNAME,
				);
			}
			if (!empty($return_value['error'])) {
				return $return_value;
			}

			$return_value = $this->_userModel->updateUserUsernameWithId($_POST['username_mediastorage'], $user_data['id']);

			if (!empty($return_value['error'])) {
				return $return_value;
			}
		}

		if ($_POST['password_mediastorage']) {
			$return_value = $this->_userModel->updateUserPasswordWithId($_POST['password_mediastorage'], $user_data['id']);
		}

		$return_value = $this->_userModel->updateUserWithoutUsernameAndPasswordWithIdAsAdmin($_POST, $user_data['id']);

		if (!empty($return_value['error'])) {
			return $return_value;
		}

		return $this->_userInfoModel->updateUserInfoWithId($_POST, $user_data['id']);
	}

	public function userEditDb($user_data) {
		if (strcmp($user_data['username'], $_POST['username_mediastorage']) != 0) {

			$return_value = $this->_userModel->findUserByUsernameAndIdOrganization($_POST['username_mediastorage'], $user_data['id_organization']);

			if ($return_value['data']->num_rows != 0) {
				return array(
					'data' => false,
					'error' => DUPLICATE_USERNAME,
				);
			}
			if (!empty($return_value['error'])) {
				return $return_value;
			}

			$return_value = $this->_userModel->updateUserUsernameWithId($_POST['username_mediastorage'], $user_data['id']);

			if (!empty($return_value['error'])) {
				return $return_value;
			}
		}

		if ($_POST['password_mediastorage']) {
			$return_value = $this->_userModel->updateUserPasswordWithId($_POST['password_mediastorage'], $user_data['id']);
		}

		$return_value = $this->_userModel->updateUserWithoutUsernameAndPasswordWithId($_POST, $user_data['id']);

		if (!empty($return_value['error'])) {
			return $return_value;
		}

		return $this->_userInfoModel->updateUserInfoWithId($_POST, $user_data['id']);
	}

	public function getAllUsersDb() {
		return $this->_userModel->findAllUsers();
	}

	public function getUserByIdDb($user_id) {
		return $this->_userModel->findUserById($user_id);
	}

	public function getUserInfoByIdDb($user_id) {
		return $this->_userInfoModel->findUserInfoById($user_id);
	}

	public function userEditFormCheck() {
		$errors_user_create = array();

		if (strlen($_POST['username_mediastorage']) == 0) {
			$errors_user_create[] = EMPTY_USERNAME;
		}
		if (strlen($_POST['username_mediastorage']) > 20) {
			$errors_user_create[] = INVALID_USERNAME_TOO_LONG;
		}
		if (strlen($_POST['password_mediastorage']) != 0) {

			if (strcmp($_POST['password_mediastorage'], $_POST['password_mediastorage_bis']) != 0) {
				$errors_user_create[] = PASSWORD_NOT_MATCH;
			}
		}
		if (strlen($_POST['first_name_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_FIRST_NAME_TOO_LONG;
		}
		if (strlen($_POST['last_name_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_LAST_NAME_TOO_LONG;
		}
		if (strlen($_POST['address_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_ADDRESS_TOO_LONG;
		}
		if (strlen($_POST['zipcode_mediastorage']) > 8) {
			$errors_user_create[] = INVALID_ZIPCODE_TOO_LONG;
		}
		if (strlen($_POST['city_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_CITY_TOO_LONG;
		}
		if (strlen($_POST['country_mediastorage']) > 50) {
			$errors_user_create[] = INVALID_COUNTRY_TOO_LONG;
		}
		if (strlen($_POST['phone_mediastorage']) > 12) {
			$errors_user_create[] = INVALID_PHONE_TOO_LONG;
		}
		if (strlen($_POST['mobile_mediastorage']) > 12) {
			$errors_user_create[] = INVALID_MOBILE_TOO_LONG;
		}
		if (strlen($_POST['company_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_COMPANY_TOO_LONG;
		}
		if (strlen($_POST['job_mediastorage']) > 200) {
			$errors_user_create[] = INVALID_JOB_TOO_LONG;
		}

		return $errors_user_create;
	}

	public function removeUserByIdDb($user_id) {
		return $this->_userModel->deleteUserById($user_id);
	}

	public function formatSelectOrganizationWithPostData() {
		$user = array();

		$user['id_organization'] = $_POST['id_organization_mediastorage'];

		return $user;
	}

	public function getAllUsersWithOrganizationDb($id_organization) {
		$this->getPagingValues($size, $offset);

		return $this->_userModel->findAllUsersWithOrganizationWithLimit($id_organization, $size, $offset);
	}

	public function setLanguageToOneByLanguageIdDb($language_id) {
		return $this->_userModel->updateLanguageToOneByLanguageIdDb($language_id);
	}

	//
	// ADMIN USER CONTROLLER'S MANAGER CODE
	//

	// List Action Code

	public function getTableDataForView(&$table_data, &$id_organization) {
		$this->getUsersForTableData($users, $id_organization);

		$this->getHtmlForTableData($table_data, $users);
	}

	private function getUsersForTableData(&$users, &$id_organization) {
		$users_data = $this->getAllUsersWithOrganizationDb($id_organization);

		// Format sql result into an array to be usable
		$users = $this->_toolboxManager->mysqliResultToArray($users_data);
	}

	private function getHtmlForTableData(&$table_data, &$users) {
		$this->getTableHeaderForTableData($table_data);

		$this->getTableDataForTableData($table_data, $users);
	}

	private function getTableHeaderForTableData(&$table_data) {
		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . USERNAME . '</th>',
				'<th>' . ORGANIZATION . '</th>',
				'<th>' . ROLE . '</th>',
				'<th>' . EMAIL . '</th>',
				'<th></th>',
				'<th></th>',
		);

		$table_data['header'] = $table_header;
	}

	private function getTableDataForTableData(&$table_data, &$users) {
		$data[] = array();

		// Fill table data with html and user data in order to have user infirmation in each column and users per lines.
		foreach ($users as $key => $value) {
			$data[] = array(
				'<td>' . $value['id'] . '</td>',
				'<td>' . $value['username'] . '</td>',
				'<td>' . $value['organization_name'] . '</td>',
				'<td>' . $value['role_role'] . '</td>',
				'<td>' . $value['email'] . '</td>',
				'<td class="td-link" >' .
					'<a href="?page=edit_user_admin&user_id=' . $value['id'] . '" class="td-link-button button-edit" >' . EDIT . '</a>' .
				'</td>',
				'<td class="td-link" >' .
					'<a href="?page=delete_user_admin&user_id=' . $value['id'] . '" class="td-link-button button-delete" >' . DELETE . '</a>' .
				'</td>',
			);
		}

		$table_data['data'] = $data;
	}

	// Paging code

	private function getPagingValues(&$size, &$offset) {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;
	}

	public function getPageNumberDb() {
		$result = $this->_userModel->getAllUserCountByIdOrganization($_SESSION['id_organization']);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerPages;

		return (ceil($pages));
	}

	public function setCurrentPage(&$current_page) {
		$current_page = (isset($_GET['paginate'])) ? intval($_GET['paginate']) : 1;
	}

	// Create action code

	public function getCreateViewData(&$select_data) {
		$this->getCreateViewSelectListData($select_data);
	}

	// Get all datas for select box
	private function getCreateViewSelectListData(&$select_data) {
		$role_data = $this->_roleManager->getAllRolesDb();
		$select_data['roles'] = $this->_toolboxManager->mysqliResultToArray($role_data);

		$languages_data = $this->_languageManager->getAllLanguagesDb();
		$select_data['languages'] = $this->_toolboxManager->mysqliResultToArray($languages_data);
	}

	public function checkFormDataAndValidityAndCreate(&$user, &$errors, &$success_redirect_url) {
		// Check if the right validate button has been pressed
		if (isset($_POST['id_user_create_mediastorage']) &&
			(strcmp($_POST['id_user_create_mediastorage'], '98475') == 0)) {
			$_POST['id_organization_mediastorage'] = $_SESSION['id_organization'];

			// Get data typed by user to reprint if fail on form validation
			$user = $this->formatUserArrayWithPostData();

			$errors['error'] = $this->userEditFormCheck();

			if (!empty($errors['error']))
				return;

			$this->createUserInDatabase($errors);

			$this->_toolboxManager->redirectOnLastPageInSession();

			$this->redirectOnSuccess($errors, $success_redirect_url);
		}

	}

	private function createUserInDatabase(&$errors) {
		$errors = $this->userCreateDb();
	}

	private function redirectOnSuccess(&$errors, &$success_redirect_url) {
		if (!empty($errors['error']))
			return;


		$_SESSION['flash_message'] = ACTION_SUCCESS;
		header('Location:' . $success_redirect_url);
		exit;
	}

	// User Edit Code

	public function checkFormDataAndValidityAndEdit(&$user, &$errors, &$success_redirect_url) {
		// Check if the right validate button has been pressed
		if (isset($_POST['id_user_create_mediastorage']) &&
			(strcmp($_POST['id_user_create_mediastorage'], '98475') == 0)) {
			$_POST['id_organization_mediastorage'] = $user['id_organization'];

			// Get data typed by user to reprint if fail on form validation

			$errors['error'] = $this->userEditFormCheck();

			if (!empty($errors['error']))
				return;

			$this->editUserInDatabase($errors, $user);

			$this->_toolboxManager->redirectOnLastPageInSession();

			$this->redirectOnSuccess($errors, $success_redirect_url);
		}

	}

	private function editUserInDatabase(&$errors, &$user) {
		$errors = $this->userEditAsAdminDb($user);
	}

	public function getUser(&$id_user, &$user) {
		$id_organization = $_SESSION['id_organization'];

		$data = $this->_userModel->findUserByIdAndIdOrganization($id_user, $id_organization);

		if (!empty($data['error']))
			return;

		$user_data = $this->_toolboxManager->mysqliResultToData($data);

		$data = $this->_userInfoModel->findUserInfoById($id_user);

		$user_info_data = $this->_toolboxManager->mysqliResultToData($data);

		$user = array_merge($user_data, $user_info_data);
	}

}