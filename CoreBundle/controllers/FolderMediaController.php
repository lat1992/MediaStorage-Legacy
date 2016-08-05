<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/FolderMediaManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class FolderMediaController {

	private $_folderManager;
	private $_folderMediaManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_folderMediaManager = new FolderMediaManager();
		$this->_mediaManager = new MediaManager();

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

	// public function listAction() {
	// 	$folders = $this->_folderMediaManager->getAllFolderMediasDb();

	// 	$this->mergeErrorArray($folderMedias);

	// 	include ('CoreBundle/views/folder/folder_media_list.php');
	// }

	public function createAction() {
		$folder_media = array();

		if (isset($_POST['id_folder_media_create_mediastorage']) && (strcmp($_POST['id_folder_media_create_mediastorage'], '84393') == 0)) {
			$folder_media = $this->_folderMediaManager->formatFolderMediaArrayWithPostData();
			$return_value['error'] = $this->_folderMediaManager->folderMediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_folderMediaManager->folderMediaCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($medias);

		include ('CoreBundle/views/folder/folder_media_create.php');
	}

	public function editAction() {
		$folder_media_data = $this->_folderMediaManager->getFolderMediaByIdDb($_GET['folder_media_id']);
		$folders = $this->_folderManager->getAllFoldersDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($folder_media_data);
		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($medias);

		if (count($this->_errorArray) == 0) {

			while ($folder_media_data_temp = $folder_media_data['data']->fetch_assoc()) {
				$folder_media = $folder_media_data_temp;
			}

			if (isset($_POST['id_folder_media_create_mediastorage']) && (strcmp($_POST['id_folder_media_create_mediastorage'], '84393') == 0)) {
				$return_value['error'] = $this->_folderMediaManager->folderMediaCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_folderMediaManager->folderMediaEditDb($folder_media);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/folder/folder_media_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['folder_media_id'])) {

			$return_value = $this->_folderMediaManager->removeFolderMediaByIdDb($_GET['folder_media_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}