<?php

require_once('CoreBundle/models/MediaFile.php');

class MediaFileManager {

	private $_mediaFileModel;

	public function __construct() {
		$this->_mediaFileModel = new MediaFile();
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