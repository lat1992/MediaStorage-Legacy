<?php

require_once('Model.php');

class User extends Model {
	

	public function __construct() {
		parent::__construct('users');
	}

	public function findUserByUsernameAndPassword($username, $password) {
		$username = $this->_mysqli->real_escape_string($username);
		$password = $this->_mysqli->real_escape_string($password);

		return $this->_mysqli->query('SELECT id, username FROM ' . $this->_table . ' WHERE username = "'. $username . '" AND password = "' . $password . '";');
	}

	public function createNewUser($username, $password) {
		$username = $this->_mysqli->real_escape_string($username);
		$password = $this->_mysqli->real_escape_string($password);
		
		return $this->_mysqli->query('INSERT INTO ' . $this->_table . '(username, password) VALUES ("'. $username . '", "' . $password . '");');
	}
}