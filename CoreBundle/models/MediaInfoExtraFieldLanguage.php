<?php

require_once('Model.php');

class MediaExtraFieldLanguage extends Model {

	public function __construct() {
		parent::__construct('media_extra_field');
	}

	public function findAllMediaExtraFieldLanguages() {
		$data = $this->_mysqli->query('SELECT id, id_organization, type, name ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaExtraFieldLanguages: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMediaExtraFieldLanguage($data) {
		$translate = array();
		$cpt = 0;
		foreach ($_POST['']) {

		}
	}

}