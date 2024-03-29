<?php

require_once('CoreBundle/models/SharelistMedia.php');

class SharelistMediaManager {

	private $_sharelistMediaModel;

	public function __construct() {
		$this->_sharelistMediaModel = new SharelistMedia();
	}

	public function getAllSharelistMediasDb() {
		return $this->_sharelistMediaModel->findAllSharelistMedias();
	}

	public function getAllSharelistMediasByUserIdAndSharelistIdDb($sharelist_id) {
		return $this->_sharelistMediaModel->findAllSharelistMediasByUserIdAndSharelistId($_SESSION['user_id_mediastorage'], $sharelist_id, $_SESSION['id_language_mediastorage']);
	}

	public function getAllSharelistMediasByUserIdDb() {
		return $this->_sharelistMediaModel->findAllSharelistMediasByUserId($_SESSION['user_id_mediastorage'], $_SESSION['id_language_mediastorage']);
	}

	public function formatSharelistMediaArrayWithPostData() {
		$sharelist_media = array();

		$sharelist_media['id_sharelist'] = $_POST['id_sharelist_mediastorage'];
		$sharelist_media['id_media'] = $_POST['id_media_mediastorage'];

		return $sharelist_media;
	}

	public function sharelistMediaCreateFormCheck() {
		$error_sharelist_media = array();

		return $error_sharelist_media;
	}

	public function sharelistMediaCreateDb() {
		return $this->_sharelistMediaModel->createNewSharelistMedia($_POST);
	}

	public function getSharelistMediaByIdDb($sharelist_media_id) {
		return $this->_sharelistMediaModel->findSharelistMediaById($sharelist_media_id);
	}

	public function sharelistMediaEditDb($sharelist_media_data) {
		return $this->_sharelistMediaModel->updateSharelistMediaWithId($_POST, $sharelist_media_data['id']);
	}

	public function removeSharelistMediaByIdDb($sharelist_media_id) {
		return $this->_sharelistMediaModel->deleteSharelistMediaById($sharelist_media_id);
	}

	public function deleteSharelistMediaBySharelistId($sharelist_id) {
		return $this->_sharelistMediaModel->deleteSharelistMediaBySharelistId($sharelist_id);
	}

	public function sharelistMediaMultipleCreateDb($sharelist_id) {

		$return_value['error'] = "";

		$_POST['id_sharelist_mediastorage'] = $sharelist_id;

		foreach ($_POST['sharelist_media_mediastorage'] as $sharelist_media_id => $value) {

			$return_value = $this->_sharelistMediaModel->updateSharelistMediaWithId($_POST, $sharelist_media_id);
			if (!empty($return_value['error']))
				return $return_value;
		}

		return $return_value;
	}

}