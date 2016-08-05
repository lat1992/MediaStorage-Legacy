<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaInfoExtraManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');

class MediaController {

	private $_mediaManager;
	private $_organizationManager;
	private $_mediaInfoManager;
	private $_mediaInfoExtraManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaInfoExtraManager = new MediaInfoExtraManager();

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

		if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {
			$media = $this->_mediaManager->formatMediaArrayWithPostData();
			$return_value['error'] = $this->_mediaManager->mediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaManager->mediaCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$parents = $this->_mediaManager->getAllMediasDb();
		$this->mergeErrorArray($parents);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		include ('CoreBundle/views/media/media_create.php');
	}

	public function editAction() {
		$media_data = $this->_mediaManager->getMediaByIdDb($_GET['media_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($media_data);
		$this->mergeErrorArray($organizations);

		if (count($this->_errorArray) == 0) {
			while ($media_data_temp = $media_data['data']->fetch_assoc()) {
				$media = $media_data_temp;
			}

			if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {
				$return_value['error'] = $this->_mediaManager->mediaCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaManager->mediaEditDb($media);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}
			}
		}

		include ('CoreBundle/views/media/media_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['media_id'])) {

			$return_value = $this->_mediaManager->removeMediaByIdDb($_GET['media_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}