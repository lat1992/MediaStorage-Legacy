<?php

require_once('CoreBundle/models/Sharelist.php');
require_once('CoreBundle/managers/SharelistMediaManager.php');

class SharelistManager {

	private $_sharelistModel;
	private $_sharelistMediaModel;

	public function __construct() {
		$this->_sharelistModel = new Sharelist();
		$this->_sharelistMediaManager = new SharelistMediaManager();
	}

	public function getAllSharelistsDb() {
		return $this->_sharelistModel->findAllSharelists();
	}

	public function getAllSharelistsByUserIdDb() {
		return $this->_sharelistModel->findAllSharelistsByUserId($_SESSION['user_id_mediastorage']);
	}

	public function formatSharelistArrayWithPostData() {
		$sharelist = array();

		$sharelist['id_user'] = $_POST['id_user_mediastorage'];
		$sharelist['reference'] = $_POST['reference_mediastorage'];

		return $sharelist;
	}

	public function sharelistCreateFormCheck() {
		$error_sharelist = array();

		if (strlen($_POST['reference_mediastorage']) == 0) {
			$error_sharelist[] = EMPTY_REFERENCE;
		}
		if (strlen($_POST['reference_mediastorage']) > 30) {
			$error_sharelist[] = INVALID_REFERENCE_TOO_LONG;
		}

		return $error_sharelist;
	}

	public function sharelistCreateDb() {
		return $this->_sharelistModel->createNewSharelist($_POST);
	}

	public function getSharelistByIdDb($sharelist_id) {
		return $this->_sharelistModel->findSharelistById($sharelist_id);
	}

	public function sharelistEditDb($sharelist_data) {
		return $this->_sharelistModel->updateSharelistWithId($_POST, $sharelist_data['id']);
	}

	public function removeSharelistByIdDb($sharelist_id) {
		$data = $this->_sharelistMediaManager->deleteSharelistMediaBySharelistId($sharelist_id);
		if (!empty($data['error']))
			return $data;

		return $this->_sharelistModel->deleteSharelistById($sharelist_id);
	}
}