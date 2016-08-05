<?php

require_once('CoreBundle/models/MediaInfoExtraField.php');

class MediaInfoExtraFieldManager {

	private $_mediaInfoExtraField;

	public function __construct() {
		$this->_mediaInfoExtraField = new MediaInfoExtraField();
	}

	public function getAllMediaInfoExtraFieldsWithMediaInfoExtraFieldLanguageAndLanguageDb() {
		return $this->_mediaInfoExtraField->findAllMediaInfoExtraFieldsWithMediaInfoExtraFieldLanguageAndLanguage();
	}

	public function getAllMediaInfoExtraFieldsDb() {
		return $this->_mediaInfoExtraField->findAllMediaInfoExtraFields();
	}

	public function formatMediaInfoExtraFieldArrayWithPostData() {
		$media_info_extra_field = array();

		$media_info_extra_field['id_organization'] = $_POST['id_organization_mediastorage'];
		$media_info_extra_field['id_language'] = $_POST['id_language_mediastorage'];
		$media_info_extra_field['type'] = $_POST['type_mediastorage'];
		$media_info_extra_field['name'] = $_POST['name_mediastorage'];

		return $media_info_extra_field;
	}

	public function mediaInfoExtraFieldCreateFormCheck() {
		$error_media_info_extra_field = array();

		if (strlen($_POST['name_mediastorage']) == 0) {
			$error_media_info_extra_field[] = EMPTY_NAME;
		}
		if (strlen($_POST['name_mediastorage']) > 20) {
			$error_media_info_extra_field[] = INVALID_NAME_TOO_LONG;
		}

		return $error_media_info_extra_field;
	}

	public function mediaInfoExtraFieldCreateDb() {
		return $this->_mediaInfoExtraField->createNewMediaInfoExtraField($_POST);
	}

	public function getMediaInfoExtraFieldByIdDb($media_info_extra_field_id) {
		return $this->_mediaInfoExtraField->findMediaInfoExtraFieldById($media_info_extra_field_id);
	}

	public function MediaInfoExtraFieldEditDb($media_info_extra_field_data) {
		return $this->_mediaInfoExtraField->updateMediaInfoExtraFieldWithId($_POST, $media_info_extra_field_data['id']);
	}

	public function removeMediaInfoExtraFieldByIdDb($media_info_extra_field_id) {
		return $this->_mediaInfoExtraField->deleteMediaInfoExtraFieldById($media_info_extra_field_id);
	}

	public function getEnumOfTypeDb() {
		$data = $this->_mediaInfoExtraField->findEnumOfType();
		if (!empty($data['error']))
			return $data;

		$enum_string;
		while ($data_temp = $data['data']->fetch_assoc()) {
			$enum_string = $data_temp['Type'];
		}

		$enum_string = substr($enum_string, 6, -2);
		$enums = explode("','", $enum_string);

		return $enums;
	}
}