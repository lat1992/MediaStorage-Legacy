<?php

require_once('CoreBundle/models/Design.php');

class DesignManager {

	private $_designModel;

	public function __construct() {
		$this->_designModel = new Design();
	}

	public function designCreateDb() {
		return $this->_designModel->createNewDesign($_POST);
	}

	public function designEditDb($design_data) {
		return $this->_designModel->updateDesignWithId($_POST, $design_data['id']);
	}

	public function getAllDesignWithOrganizationDb($id_organization) {
		return $this->_designModel->findAllDesignsWithOrganization($id_organization);
	}

	public function createOrEditDesignsDb() {

		foreach ($_POST['design_mediastorage'] as $selector => $row) {

			foreach ($row as $property => $data) {

				$_POST['selector'] = $selector;
				$_POST['property'] = $property;
				$_POST['value'] = $data['value'];
				$_POST['id_organization'] = $_GET['id_organization'];

				if (intval($data['id']) != 0) {
					$return_value = $this->designEditDb($data);

					if (!empty($return_value['error']))
						return $return_value;
				}
				else {
					$return_value = $this->designCreateDb();

					if (!empty($return_value['error']))
						return $return_value;
				}
			}
		}
	}

	public function formatDataForView($data) {

		$return_array = array();

		foreach($data as $row) {
			$return_array[$row['selector']][$row['property']]['value'] = $row['value'];
			$return_array[$row['selector']][$row['property']]['id'] = $row['id'];
		}

		return $return_array;
	}
}