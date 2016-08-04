<?php

require_once('Model.php');

class UserInfo extends Model {

	public function __construct() {
		parent::__construct('user_info');
	}

	public function createNewUserInfo($data, $user_id) {
		$first_name = $this->_mysqli->real_escape_string($data['first_name_mediastorage']);
		$last_name = $this->_mysqli->real_escape_string($data['last_name_mediastorage']);
		$address = $this->_mysqli->real_escape_string($data['address_mediastorage']);
		$zipcode = $this->_mysqli->real_escape_string($data['zipcode_mediastorage']);
		$city = $this->_mysqli->real_escape_string($data['city_mediastorage']);
		$country = $this->_mysqli->real_escape_string($data['country_mediastorage']);
		$phone = $this->_mysqli->real_escape_string($data['phone_mediastorage']);
		$mobile = $this->_mysqli->real_escape_string($data['mobile_mediastorage']);
		$company = $this->_mysqli->real_escape_string($data['company_mediastorage']);
		$job = $this->_mysqli->real_escape_string($data['job_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id, first_name, last_name, address, zipcode, city, country, phone, mobile, company, job) VALUES ("'. $user_id . '", "' . $first_name . '", "' . $last_name . '", "' . $address . '", "' . $zipcode . '", "' . $city . '", "' . $country . '", "' . $phone . '", "' . $mobile . '", "' . $company . '", "' . $job . '");');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewUserInfo: ' . $this->_mysqli->error : ''
		);
	}

	public function findUserInfoById($id) {
		$data = $this->_mysqli->query('SELECT first_name, last_name, address, zipcode, city, country, phone, mobile, company, job FROM ' . $this->_table . ' WHERE id = ' . $id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findUserInfoById: ' . $this->_mysqli->error : '',
		);
	}

	public function updateUserInfoWithId($data, $user_id) {

		$first_name = $this->_mysqli->real_escape_string($data['first_name_mediastorage']);
		$last_name = $this->_mysqli->real_escape_string($data['last_name_mediastorage']);
		$address = $this->_mysqli->real_escape_string($data['address_mediastorage']);
		$zipcode = $this->_mysqli->real_escape_string($data['zipcode_mediastorage']);
		$city = $this->_mysqli->real_escape_string($data['city_mediastorage']);
		$country = $this->_mysqli->real_escape_string($data['country_mediastorage']);
		$phone = $this->_mysqli->real_escape_string($data['phone_mediastorage']);
		$mobile = $this->_mysqli->real_escape_string($data['mobile_mediastorage']);
		$company = $this->_mysqli->real_escape_string($data['company_mediastorage']);
		$job = $this->_mysqli->real_escape_string($data['job_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table . ' SET first_name = "' . $first_name . '", last_name = "' . $last_name . '", address = "' . $address . '", zipcode = "' . $zipcode . '", city = "' . $city . '", country = "' . $country . '", phone = "' . $phone . '", mobile = "' . $mobile . '", company = "' . $company . '", job = "' . $job . '" WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateUserInfoWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteUserInfoById($user_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table . ' WHERE id = ' . $user_id . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteUserById: ' . $this->_mysqli->error : '',
		);
	}
}