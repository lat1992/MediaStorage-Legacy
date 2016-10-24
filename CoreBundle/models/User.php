<?php

require_once('Model.php');
require_once('CoreBundle/models/UserInfo.php');

class User extends Model {

	private $_userInfoModel;

	public function __construct() {
		parent::__construct('user');

		$this->_userInfoModel = new UserInfo();
	}

	public function findUserByUsernameAndPassword($username, $password, $id_organization) {
		$username = $this->_mysqli->real_escape_string($username);
		$password = $this->_mysqli->real_escape_string($password);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$result = $this->_mysqli->query('SELECT user.id, username, password, id_role, id_language, id_organization, id_group FROM ' . $this->_table .
			' LEFT JOIN `organization` ON organization.id = id_organization ' .
			' WHERE username = "'. $username . '" AND id_organization = ' . $id_organization . ';');

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				if (password_verify($password, $row['password']))
					return array(
						'data' => $row,
						'error' => ($this->_mysqli->error) ? 'findUserByUsernameAndPassword: ' . $this->_mysqli->error : '',
					);
			}
		}

		return array(
			'data' => false,
			'error' => ($this->_mysqli->error) ? 'findUserByUsernameAndPassword: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewUser($data) {
		$username = $this->_mysqli->real_escape_string($data['username_mediastorage']);
		$password = $this->_mysqli->real_escape_string($data['password_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$email = $this->_mysqli->real_escape_string($data['email_mediastorage']);

		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		if ($this->_mysqli->query('INSERT INTO ' . $this->_table . '(username, password, id_organization, id_role, id_language, email) VALUES ("'. $username . '", "' . $hashed_password . '", "' . $id_organization . '", "' . $id_role . '", "' . $id_language . '", "' . $email . '");')) {
			if ($this->_userInfoModel->createNewUserInfo($data, $this->_mysqli->insert_id)) {
				return array(
					'data' => true,
					'error' => '',
				);
			}
			else {
				return array(
					'data' => false,
					'error' => ($this->_mysqli->error) ? 'createNewUser__info: ' . $this->_mysqli->error : '',
				);
			}
		}
		return array(
			'data' => false,
			'error' => ($this->_mysqli->error) ? 'createNewUser: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllUsers() {
		$data = $this->_mysqli->query('SELECT '.$this->_table.'.id, username, '.$this->_table.'.id_organization, id_role, email, organization.name AS organization_name, role.role AS role_role FROM ' . $this->_table .
			' LEFT JOIN organization ON '.$this->_table.'.id_organization = organization.id' .
			' LEFT JOIN role ON id_role = role.id;');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllUsers: ' . $this->_mysqli->error : '',
		);
	}

	public function findUserById($id) {
		$id = $this->_mysqli->real_escape_string($id);

		$data = $this->_mysqli->query('SELECT id, username, password, id_role, id_language, id_organization, email FROM ' . $this->_table . ' WHERE id = ' . $id . ';');
		$tmp = $data->fetch_assoc();
		$data->data_seek(0);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findUserById: ' . $this->_mysqli->error : '',
			'id_organization' => $tmp['id_organization'],
		);
	}

	public function findUserByUsernameAndIdOrganization($username, $id_organization) {
		$username = $this->_mysqli->real_escape_string($username);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id FROM ' . $this->_table . ' WHERE username = "' . $username . '" AND id_organization = ' . $id_organization . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findUserByUsernameAndIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function updateUserUsernameWithId($username, $user_id) {
		$username = $this->_mysqli->real_escape_string($username);
		$user_id = $this->_mysqli->real_escape_string($user_id);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table . ' SET username = "' . $username . '" WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'editUserUsernameWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function updateUserPasswordWithId($password, $user_id) {
		$password = $this->_mysqli->real_escape_string($password);
		$user_id = $this->_mysqli->real_escape_string($user_id);

		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table . ' SET password = "' . $hashed_password . '" WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateUserPasswordWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function updateUserWithoutUsernameAndPasswordWithIdAsAdmin($data, $user_id) {

		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_role = $this->_mysqli->real_escape_string($data['id_role_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$email = $this->_mysqli->real_escape_string($data['email_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table . ' SET id_organization = ' . $id_organization . ', id_role = ' . $id_role . ', id_language = ' . $id_language . ', email = "' . $email . '" WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateUserWithoutUsernameAndPasswordWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function updateUserWithoutUsernameAndPasswordWithId($data, $user_id) {

		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);
		$email = $this->_mysqli->real_escape_string($data['email_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table . ' SET id_language = ' . $id_language . ', email = "' . $email . '" WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateUserWithoutUsernameAndPasswordWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteUserById($user_id) {

		$data = $this->_userInfoModel->deleteUserInfoById($user_id);
		if (!empty($data['error']))
			return $data;

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table . ' WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteUserById: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllUsersWithOrganization($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT '.$this->_table.'.id, username, '.$this->_table.'.id_organization, id_role, email, organization.name AS organization_name, role.role AS role_role FROM ' . $this->_table .
			' LEFT JOIN organization ON '.$this->_table.'.id_organization = organization.id' .
			' LEFT JOIN role ON id_role = role.id'.
			' WHERE '.$this->_table.'.id_organization = '. $id_organization .';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllUsersWithOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function updateLanguageToOneByLanguageIdDb($language_id) {
		$data = $this->_mysqli->query('UPDATE user SET id_language = 1 WHERE id_language = '.$language_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateLanguageToOneByLanguageIdDb: ' . $this->_mysqli->error : '',
		);
	}
}