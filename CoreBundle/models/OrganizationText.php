<?php

require_once('Model.php');

class OrganizationText extends Model {

	public function __construct() {
		parent::__construct('organization_text');
	}

	public function findOrganizationTextByIdDb($organization_id, $language_id) {
		$organization_id = $this->_mysqli->real_escape_string($organization_id);
		$data = $this->_mysqli->query('SELECT text, general_condition FROM '.$this->_table.' WHERE id_organization = ' . $organization_id . ' AND id_language = '. $language_id .';'
		);
		
		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findOrganizationTextById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteOrganizationTextByLanguageIdDb($language_id) {
		$data = $this->_mysqli->query('DELETE FROM '.$this->_table.' WHERE id_language = '.$language_id);
		
		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteOrganizationTextByLanguageIdDb: ' . $this->_mysqli->error : '',
		);
	}
}