<?php

require_once('CoreBundle/models/MediaFile.php');

class MediaFileManager {

	private $_mediaFileModel;

	public function __construct() {
		$this->_mediaFileModel = new MediaFile();
	}

	public function getAllMediaFilesDb() {
		return $this->_mediaFileModel->findAllMediaFiles();
	}

	public function getAllMediaFilesWithoutMediaIdDb() {
		return $this->_mediaFileModel->findAllMediaFilesWithoutMediaId();
	}

	public function getAllMediaFilesByMediaIdDb($id_media) {
		return $this->_mediaFileModel->findAllMediaFilesByMediaId($id_media);
	}

	public function createMediaFileDb() {
		return $this->_mediaFileModel->createMediaFile($_POST, $_SESSION['id_organization']);
	}

	public function updateMultipleMediaFilesDb() {
		$return_value = null;

		if (isset($_POST['media_file_mediastorage'])) {

			foreach ($_POST['media_file_mediastorage'] as $key => $value) {

				$return_value = $this->_mediaFileModel->updateMediaFileMediaId($key, $_POST['id_media_mediastorage']);

				if (!empty($return_value['error']))
					return $return_value;
			}
		}

		return $return_value;
	}

	public function formatPostDataFromFileUpload($result) {
		$_POST['id_media_mediastorage'] = 'NULL';
		$_POST['type_mediastorage'] = 'NULL';
		$_POST['filename_mediastorage'] = $result['uploadName'];
		$_POST['filepath_mediastorage'] = $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/' . $result['uuid'] . '/' . $result['uploadName'];
		$_POST['metadata_mediastorage'] = 'NULL';
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

	public function getMediaFile($id_media_file, $file_server) {
		$media_file = $this->_mediaFileModel->findMediaFileByMediaFileId($id_media_file);
		if (!empty($media_file['error'])) {
			return $media_file;
		}
		$row = $media_file['data']->fetch_assoc();
		$file_path = $file_server . $row['filepath'];
		$file_name = $row['filename'];
		$file_type = $row['mine_type'];
		/*
		** TODO
		*/
	}
}