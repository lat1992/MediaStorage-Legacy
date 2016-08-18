<?php

require_once('CoreBundle/models/MediaExtraFieldLanguage.php');

class MediaExtraFieldLanguageManager {

	private $_mediaExtraFieldLanguage;

	public function __construct() {
		$this->_mediaExtraFieldLanguage = new MediaExtraFieldLanguage();
	}

	public function formatMediaExtraFieldLanguageArrayWithPostData() {
		$translate = array();
		$cpt = 0;
		foreach ($_POST['media_extra_field_data_mediastorage'] as $key => $value) {
			if ($value) {
				$translate[$cpt]['id_language'] = $key;
				$translate[$cpt]['data'] = $value;
				$cpt++;
			}
		}
		$_POST['media_extra_field_data_mediastorage'] = $translate;
		$media_extra_field['translates'] = $_POST['media_extra_field_data_mediastorage'];
		return $media_extra_field_language;
	}

	public function mediaExtraFieldLanguageCreateFormCheck() {
		$error_media_extra_field_language = array();

		foreach ($_POST['media_extra_field_data_mediastorage'] as $key => $value) {
			if (strlen($value) > 20) {
				$error_media_extra_field_language[] = INVALID_TRANSLATE_TOO_LONG;
			}
		}

		return ($error_media_extra_field_language);
	}

	public function mediaExtraFieldLanguageCreateDb() {
		return $this->_mediaExtraFieldLanguage->createNewMediaExtraFieldLanguage($_POST);
	}
}