<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class ContentPageController {

	private $_mediaManager;
	private $_mediaInfoManager;
	private $_mediaExtraFieldManager;
	private $_toolboxManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		$this->_toolboxManager = new ToolboxManager();

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

	public function contentPageAction() {

		if (isset($_GET['media_id'])) {
			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);
			$title = $this->_mediaManager->formatPathData($title);

			$media_infos_data = $this->_mediaInfoManager->getMediaInfoByMediaIdDb($_GET['media_id']);
			$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(1);
			$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($_GET['media_id']);

			$this->mergeErrorArray($media_infos_data);
			$this->mergeErrorArray($media_extra_data);
			$this->mergeErrorArray($media_extras_user_data);

			$media_infos = $this->_toolboxManager->mysqliResultToArray($media_infos_data);
			$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);

			$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

			$media_infos = $this->_mediaInfoManager->getArrayWithIdLanguageKey($media_infos);
			var_dump($media_extra);exit;
		}
		else {
			$title = CONTENT;
		}

		include ('ClientBundle/views/content/content.php');
	}
}