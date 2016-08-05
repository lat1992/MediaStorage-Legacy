<?php

require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/LanguageManager.php');

class MediaInfoController {

	private $_mediaInfoManager;
	private $_mediaManager;
	private $_languageManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaManager = new MediaManager();
		$this->_languageManager = new LanguageManager();

		$this->_errorArray = array();
	}

	private function mergeErrorArray($errorArray) {
		if (!empty($errorArray['error'])) {
			if (!is_array($errorArray['error'])) {
				$data_array[] = $errorArray['error'];
			}
			else {
				$data_array = $errorArray['error'];
			}
			$this->_errorArray = array_merge ($this->_errorArray, $data_array);
		}
	}

	public function createAction() {
		$media = array();

		if (isset($_POST['id_media_info_create_mediastorage']) && (strcmp($_POST['id_media_info_create_mediastorage'], '12646') == 0)) {
			$media_info = $this->_mediaInfoManager->formatMediaInfoArrayWithPostData();
			$return_value['error'] = $this->_mediaInfoManager->mediaInfoCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaInfoManager->mediaInfoCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$medias = $this->_mediaManager->getAllMediasDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($medias);
		$this->mergeErrorArray($languages);

		include ('CoreBundle/views/media/media_info_create.php');
	}

	public function editAction() {
		$media_info_data = $this->_mediaInfoManager->getMediaInfoByIdDb($_GET['media_info_id']);
		$medias = $this->_mediaManager->getAllMediasDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($media_info_data);
		$this->mergeErrorArray($medias);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($media_info_data_temp = $media_info_data['data']->fetch_assoc()) {
				$media_info = $media_info_data_temp;
			}

			if (isset($_POST['id_media_info_create_mediastorage']) && (strcmp($_POST['id_media_info_create_mediastorage'], '12646') == 0)) {
				$return_value['error'] = $this->_mediaInfoManager->mediaInfoCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaInfoManager->mediaInfoEditDb($media_info);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}
		}

		include ('CoreBundle/views/media/media_info_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_info_id'])) {

			$return_value = $this->_mediaInfoManager->removeMediaInfoByIdDb($_GET['media_info_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}