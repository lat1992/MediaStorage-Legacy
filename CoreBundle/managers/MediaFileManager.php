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

	public function getAllMediaFilesByDirectory() {
		$return_array = array();

		if (is_dir ( 'uploads/media_files/files/' . $_SESSION['id_organization'] )) {
			if ($handle = opendir('uploads/media_files/files/' . $_SESSION['id_organization'])) {
			    while (false !== ($entry = readdir($handle))) {
			    	if (strcmp('.', $entry) && strcmp('..', $entry) && strcmp('tmp', $entry) && strcmp('tmp_to_move', $entry)) {
			        	$return_array[] = $entry;
			    	}
			    }
			    closedir($handle);
			}
		}

		return $return_array;
	}

	public function getAllMediaFilesByMediaIdDb($id_media) {
		return $this->_mediaFileModel->findAllMediaFilesByMediaId($id_media);
	}

	public function createMediaFileDb() {
		return $this->_mediaFileModel->createMediaFile($_POST, $_SESSION['id_organization']);
	}

	public function getMediaFileByIdDb($id_media_file) {
		return $this->_mediaFileModel->findMediaFileById($id_media_file);
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
		$_POST['filepath_mediastorage'] = $result['file_path'];
		$_POST['metadata_mediastorage'] = 'NULL';
		$_POST['right_download_mediastorage'] = 1;
		$_POST['right_preview_mediastorage'] = 1;
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

	public function getMediaFileByToken($token) {
		return $this->_mediaFileModel->findMediaFileByToken($token);
	}

	public function getMediaFileStreamByData($data) {
		if ($row = $data['data']->fetch_assoc()) {
			if (ob_get_level()) {
      			ob_end_clean();
    		}
			header('Content-type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.$row['filename'].'"');
			header('Content-Transfer-Encoding: binary\n');
			header('Content-length: '.filesize($row['filepath']));
			readfile($row['filepath']);
			exit ;
		}
	}

	public function formatPostDataForMultipleQualification() {
		foreach ($_POST['media_file_mediastorage'] as $key => $media_file) {
			if (!isset($media_file['name']))
				unset($_POST['media_file_mediastorage'][$key]);
		}
	}

	public function preparePostDataForMediaFileCreation($media_file) {
		$_POST['type_mediastorage'] = 'NULL';
		$_POST['filename_mediastorage'] = str_replace(' ', '_', $media_file['name']);//$media_file['name'];
		$_POST['metadata_mediastorage'] = 'NULL';
		$_POST['right_download_mediastorage'] = $media_file['right_download'];
		$_POST['right_preview_mediastorage'] = $media_file['right_preview'];

		$old_path = 'uploads/media_files/files/' . $_SESSION['id_organization'] . '/' . $media_file['name'];
		$new_path = 'uploads/media_files/files/' . $_SESSION['id_organization'] . '/tmp_to_move/' . str_replace(' ', '_', $media_file['name']);

		rename($old_path, $new_path);

		$_POST['filepath_mediastorage'] = $new_path;

	}

	public function removeMediaFileByMediaIdDb($media_id) {
		return $this->_mediaFileModel->deleteMediaFileByMediaId($media_id);
	}

	public function removeMediaFileByMediaNameDb($media_name) {
        $basePath = 'uploads/media_files/files/' . $_SESSION['id_organization'] . '/';

		unlink($basePath . $media_name);
	}
}