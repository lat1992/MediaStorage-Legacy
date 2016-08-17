<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class MediaController {

	private $_mediaManager;
	private $_folderManager;
	private $_mediaFileManager;
	private $_languageManager;
	private $_mediaExtraFieldManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_folderManager = new FolderManager();
		$this->_mediaFileManager = new MediaFileManager();
		$this->_languageManager = new LanguageManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();

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

		include ('AdminBundle/views/media/media_create.php');
	}

	public function createProgramAction() {
		$media = array();

		if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {
			$this->_mediaManager->preFillProgramPostData();
			var_dump($_POST);exit;
			// $media = $this->_mediaManager->formatMediaArrayWithPostData();
			// $return_value['error'] = $this->_mediaManager->mediaCreateFormCheck();
			// $this->mergeErrorArray($return_value);

			// if (count($this->_errorArray) == 0) {
			// 	$return_value = $this->_mediaManager->mediaCreateDb();
			// 	$this->mergeErrorArray($return_value);

			// 	if (count($this->_errorArray) == 0) {
			// 		header('Location:' . '?page=dashboard');
			// 	}
			// }
		}

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$enums = $this->_mediaFileManager->getEnumOfTypeDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();
		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(1);

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($enums);
		$this->mergeErrorArray($languages);
		$this->mergeErrorArray($media_extra_data);

		if (count($this->_errorArray) == 0) {

			$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

			$enums = $enums['data'];
		}
// 		ini_set('xdebug.var_display_max_depth', -1);
// ini_set('xdebug.var_display_max_children', -1);
// ini_set('xdebug.var_display_max_data', -1);
// 		var_dump($media_extra);
// exit;


		include ('AdminBundle/views/media/media_create.php');
	}

	public function editAction() {
		$media_data = $this->_mediaManager->getMediaByIdDb($_GET['media_id']);
		$parents = $this->_mediaManager->getAllMediasDb();
		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($media_data);
		$this->mergeErrorArray($parents);
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

	public function ajaxGetMediaByParentIdAction() {
		if (!$_GET['media_id']) {
			echo '';
			return;
		}

		$media_data = $this->_mediaManager->ajaxGetMediaByParentIdDb($_GET['media_id']);
		$this->mergeErrorArray($media_data);

		if (count($this->_errorArray) == 0) {

			$media = array();

			while ($media_data_temp = $media_data['data']->fetch_assoc()) {
				$media[] = $media_data_temp;
			}

			if ($media)
				echo json_encode($media);
		}

		echo '';
		return;
	}
}