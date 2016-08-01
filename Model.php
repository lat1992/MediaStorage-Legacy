<?php

abstract class Model {
	
	protected $_mysqli;

	protected $_table;

	public function __construct($table) {

		$this->_table = $table;

		$settings = parse_ini_file('config.ini.php', true);

		$this->_mysqli = new mysqli($settings['database']['host'], $settings['database']['username'], $settings['database']['password'], $settings['database']['databasename']);

		$this->_mysqli->set_charset("utf8");
	}

}