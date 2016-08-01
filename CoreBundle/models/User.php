<?php

require_once('Model.php');

class User extends Model {
	

	public function __construct() {
		parent::__construct('user');
	}

	public function findUserByUsernameAndPassword($username, $password) {
		$username = $this->_mysqli->real_escape_string($username);
		$password = $this->_mysqli->real_escape_string($password);

		$result = $this->_mysqli->query('SELECT id, username, password, id_role, id_language FROM ' . $this->_table . ' WHERE username = "'. $username . '";');

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				if (password_verify($password, $row['password']))
					return $row;
			}			
		}

		return false;
	}

	public function createNewUser($username, $password) {
		$username = $this->_mysqli->real_escape_string($username);
		$password = $this->_mysqli->real_escape_string($password);
		
		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		return $this->_mysqli->query('INSERT INTO ' . $this->_table . '(username, password) VALUES ("'. $username . '", "' . $hashed_password . '");');
	}
}