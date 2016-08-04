<?php

require_once('CoreBundle/managers/SharelistManager.php');
require_once('CoreBundle/managers/SharelistMediaManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class SharelistMediaController {

	private $_sharelistManager;
	private $_sharelistMediaManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_sharelistManager = new SharelistManager();
		$this->_sharelistMediaManager = new SharelistMediaManager();
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
	// 	$sharelists = $this->_sharelistMediaManager->getAllSharelistMediasDb();

	// 	$this->mergeErrorArray($sharelistMedias);

	// 	include ('CoreBundle/views/sharelist/sharelist_media_list.php');
	// }

	public function createAction() {
		$sharelist_media = array();

		if (isset($_POST['id_sharelist_media_create_mediastorage']) && (strcmp($_POST['id_sharelist_media_create_mediastorage'], '84393') == 0)) {
			$sharelist_media = $this->_sharelistMediaManager->formatSharelistMediaArrayWithPostData();
			$return_value['error'] = $this->_sharelistMediaManager->sharelistMediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_sharelistMediaManager->sharelistMediaCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$sharelists = $this->_sharelistManager->getAllSharelistsDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($sharelists);
		$this->mergeErrorArray($medias);

		include ('CoreBundle/views/sharelist/sharelist_media_create.php');
	}

	public function editAction() {
		$sharelist_media_data = $this->_sharelistMediaManager->getSharelistMediaByIdDb($_GET['sharelist_media_id']);
		$sharelists = $this->_sharelistManager->getAllSharelistsDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($sharelist_media_data);
		$this->mergeErrorArray($sharelists);
		$this->mergeErrorArray($medias);

		while ($sharelist_media_data_temp = $sharelist_media_data['data']->fetch_assoc()) {
			$sharelist_media = $sharelist_media_data_temp;
		}

		if (isset($_POST['id_sharelist_media_create_mediastorage']) && (strcmp($_POST['id_sharelist_media_create_mediastorage'], '84393') == 0)) {
			$return_value['error'] = $this->_sharelistMediaManager->sharelistMediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_sharelistMediaManager->sharelistMediaEditDb($sharelist_media);
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}

		}

		include ('CoreBundle/views/sharelist/sharelist_media_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['sharelist_media_id'])) {

			$return_value = $this->_sharelistMediaManager->removeSharelistMediaByIdDb($_GET['sharelist_media_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}