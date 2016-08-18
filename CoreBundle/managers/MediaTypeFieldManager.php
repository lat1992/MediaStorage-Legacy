<?php

require_once('CoreBundle/models/MediaTypeField.php');

class MediaTypeFieldManager {

	private $_mediaTypeFieldModel;

	public function __construct() {
		$this->_mediaTypeFieldModel = new MediaTypeField();
	}

	public function getAllMediaTypeFieldsDb() {
		return $this->_mediaTypeFieldModel->findAllMediaTypeFields();
	}

	public function formatMediaTypeFieldArrayWithPostData() {
		$media_type_field = array();

		$media_type_field['id_type'] = $_POST['id_type_mediastorage'];
		$media_type_field['id_field'] = $_POST['id_media_extra_field_mediastorage'];

		return $media_type_field;
	}

	public function mediaTypeFieldCreateFormCheck() {
		$error_media_type_field = array();

		return $error_media_type_field;
	}

	public function mediaTypeFieldCreateDb() {
		return $this->_mediaTypeFieldModel->createNewMediaTypeField($_POST);
	}

	public function getMediaTypeFieldByIdDb($media_type_field_id) {
		return $this->_mediaTypeFieldModel->findMediaTypeFieldById($media_type_field_id);
	}

	public function mediaTypeFieldEditDb($media_type_field_data) {
		return $this->_mediaTypeFieldModel->updateMediaTypeFieldWithId($_POST, $media_type_field_data['id']);
	}

	public function removeMediaTypeFieldByIdDb($media_type_field_id) {
		return $this->_mediaTypeFieldModel->deleteMediaTypeFieldById($media_type_field_id);
	}
}