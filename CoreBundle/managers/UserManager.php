<?php

require_once('CoreBundle/models/User.php');
require_once('CoreBundle/models/UserInfo.php');

require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/RolePermitManager.php');

class UserManager {

	private $_userModel;
	private $_userInfoModel;

	private $_languageManager;
	private $_rolePermitManager;

	public function __construct() {
		$this->_userModel = new User();
		$this->_userInfoModel = new UserInfo();

		$this->_languageManager = new LanguageManager();
		$this->_rolePermitManager = new RolePermitManager();
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
	 			'error' => $result['error'],
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
		return $this->_userModel->findAllUsersWithOrganization($id_organization);
	}

	public function setLanguageToOneByLanguageIdDb($language_id) {
		return $this->_userModel->updateLanguageToOneByLanguageIdDb($language_id);
	}
}