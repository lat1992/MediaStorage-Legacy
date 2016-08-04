<?php

require_once('CoreBundle/models/Permit.php');

class PermitManager {

	private $_permitModel;

	public function __construct() {
		$this->_permitModel = new Permit();
	}

	public function getAllPermitsDb() {
		return $this->_permitModel->findAllPermits();
	}

	public function formatPermitArrayWithPostData() {
		$permit = array();

		$permit['id_'] = $_POST['id__mediastorage'];
		$permit['id_permit'] = $_POST['id_permit_mediastorage'];

		return $permit;
	}

	public function permitCreateFormCheck() {
		$error_permit = array();

		return $error_permit;
	}

	public function permitCreateDb() {
		return $this->_permitModel->createNewPermit($_POST);
	}

	public function permitEditDb($_permit_data) {
		return $this->_permitModel->updatePermitWithId($_POST, $_permit_data['id']);
	}

	public function getPermitByIdDb($_permit_id) {
		return $this->_permitModel->findPermitById($_permit_id);
	}

	public function removePermitByIdDb($_permit_id) {
		return $this->_permitModel->deletePermitById($_permit_id);
	}
}

