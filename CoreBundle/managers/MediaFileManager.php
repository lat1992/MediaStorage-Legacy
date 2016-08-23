<?php

require_once('CoreBundle/models/MediaFile.php');

class MediaFileManager {

	private $_mediaFileModel;

	public function __construct() {
		$this->_mediaFileModel = new MediaFile();
	}

	public function createMediaFileDb() {
		$this->_mediaFileModel->createMediaFile($_POST);
	}

	public function formatPostDataFromFileUpload($result) {
		$_POST['id_media_mediastorage'] = 'NULL';
		$_POST['type_mediastorage'] = 'NULL';
		$_POST['filename_mediastorage'] = $result['uploadName'];
		$_POST['filepath_mediastorage'] = $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/' . $result['uuid'] . '/' . $result['uploadName'];
		$_POST['meta_data_mediastorage'] = 'NULL';
		$_POST['right_download_mediastorage'] = 1;
		$_POST['right_addtocart_mediastorage'] = 1;
	}

	public function getEnumOfTypeDb() {
		$data = $this->_mediaFileModel->findEnumOfType();
		if (!empty($data['error']))
			return $data;

		$enum_string;
		while ($data_temp = $data['data']->fetch_assoc()) {
			$enum_string = $data_temp['Type'];
		}

		$enum_string = substr($enum_string, 6, -2);
		$enums['data'] = explode("','", $enum_string);

		return $enums;
	}
}