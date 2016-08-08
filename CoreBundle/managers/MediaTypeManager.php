<?php

require_once('CoreBundle/models/MediaType.php');

class MediaTypeManager {

	private $_mediaType;

	public function __construct() {
		$this->_mediaType = new MediaType();
	}

	public function getAllMediaTypesWithMediaTypeLanguageAndLanguageDb() {
		return $this->_mediaType->findAllMediaTypesWithMediaTypeLanguageAndLanguage();
	}

	public function getAllMediaTypesDb() {
		return $this->_mediaType->findAllMediaTypes();
	}

	public function formatMediaTypeArrayWithPostData() {
		$media_type = array();

		$media_type['type'] = $_POST['type_mediastorage'];

		return $media_type;
	}

	public function mediaTypeCreateFormCheck() {
		$error_media_type = array();

		if (strlen($_POST['type_mediastorage']) == 0) {
			$error_media_type[] = EMPTY_TYPE;
		}
		if (strlen($_POST['type_smediastorage']) > 20) {
			$error_media_type[] = INVALID_TYPE_TOO_LONG;
		}

		return $error_media_type;
	}

	public function mediaTypeCreateDb() {
		return $this->_mediaType->createNewMediaType($_POST);
	}

	public function getMediaTypeByIdDb($media_type_id) {
		return $this->_mediaType->findMediaTypeById($media_type_id);
	}

	public function mediaTypeEditDb($media_type_data) {
		return $this->_mediaType->updateMediaTypeWithId($_POST, $media_type_data['id']);
	}

	public function removeMediaTypeByIdDb($media_type_id) {
		return $this->_mediaType->deleteMediaTypeById($media_type_id);
	}
}