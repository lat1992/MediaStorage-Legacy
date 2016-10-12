<?php

require_once('Model.php');

class Design extends Model {

	public function __construct() {
		parent::__construct('design');
	}
	public function findAllDesignsWithOrganization($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_organization, selector, property, value ' .
			' FROM ' . $this->_table .
			' WHERE id_organization ='. $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllDesignsWithOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewDesign($data) {
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization']);
		$selector = $this->_mysqli->real_escape_string($data['selector']);
		$property = $this->_mysqli->real_escape_string($data['property']);
		$value = $this->_mysqli->real_escape_string($data['value']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_organization, selector, property, value)' .
			' VALUES ("'. $id_organization . '", "' . $selector . '", "' . $property . '", "' . $value . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewDesign: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
		);
	}

	public function updateDesignWithId($data, $design_id) {
		$design_id = $this->_mysqli->real_escape_string($design_id);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization']);
		$selector = $this->_mysqli->real_escape_string($data['selector']);
		$property = $this->_mysqli->real_escape_string($data['property']);
		$value = $this->_mysqli->real_escape_string($data['value']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', selector = "' . $selector . '", property = "' . $property . '", value = "' . $value . '"' .
			' WHERE id = ' . $design_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateRoleWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteDesignWithOrganizationId($organization_id) {
		$data = $this->_mysqli->query('DELETE FROM '.$this->_table.' WHERE id_organization = '.$organization_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteDesignWithOrganizationId: ' . $this->_mysqli->error : '',
		);
	}
}