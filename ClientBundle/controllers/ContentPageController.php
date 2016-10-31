<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/ChapterManager.php');
require_once('CoreBundle/managers/ChapterLanguageManager.php');

class ContentPageController {

	private $_mediaManager;
	private $_mediaInfoManager;
	private $_mediaFileManager;
	private $_mediaExtraManager;
	private $_mediaExtraFieldManager;
	private $_toolboxManager;
	private $_designManager;
	private $_chapterManager;
	private $_chapterLanguageManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_mediaFileManager = new MediaFileManager();
		$this->_mediaExtraManager = new MediaExtraManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();
		$this->_chapterManager = new ChapterManager();
		$this->_chapterLanguageManager = new ChapterLanguageManager();

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

	public function listContentAction() {

		$contents = $this->_mediaManager->getAllContentsByIdOrganizationDb();
		$this->mergeErrorArray($contents);
		$contents = $this->_mediaManager->formatProgramPageContentForCard($contents);

		$title['title'] = CONTENT;

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/program/program.php');

	}

	public function contentPageAction() {

		if (isset($_POST) && isset($_POST['chapter_create'])) {

			$return_value = $this->_chapterManager->checkFormForChapterData();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_chapterManager->chapterCreateDb();
				$this->mergeErrorArray($return_value);

				$_POST['id_chapter_mediastorage'] = $return_value['id'];
				$_POST['id_language_mediastorage'] = $_SESSION['id_language_mediastorage'];

				$return_value = $this->_chapterLanguageManager->chapterLanguageCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$_SESSION['flash_message'] = ACTION_SUCCESS;
					header('Location:' . '?page=content&media_id=' .$_GET['media_id']);
					exit;
				}
			}
		}

		if (isset($_GET['media_id'])) {
			$title = $this->_mediaManager->getMediaByMediaId($_GET['media_id']);
			$title = $this->_mediaManager->formatPathData($title);

			$media_infos_data = $this->_mediaInfoManager->getMediaInfoByMediaIdAndLanguageIdDb($_GET['media_id'], $_SESSION['id_language_mediastorage']);
			$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
			$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($_GET['media_id']);
			$media_files_data = $this->_mediaFileManager->getAllMediaFilesByMediaIdDb($_GET['media_id']);

			$this->mergeErrorArray($media_infos_data);
			$this->mergeErrorArray($media_extra_data);
			$this->mergeErrorArray($media_extras_user_data);
			$this->mergeErrorArray($media_files_data);

			$media_infos = $this->_toolboxManager->mysqliResultToArray($media_infos_data);
			$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
			$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);

			$media_files = $this->_toolboxManager->mysqliResultToArray($media_files_data);

			$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

			$media_infos = $this->_mediaInfoManager->getArrayWithIdLanguageKey($media_infos);

			$chapters_data = $this->_chapterManager->getChapterByMediaIdDb($_GET['media_id']);
			$chapters = $this->_toolboxManager->mysqliResultToArray($chapters_data);

			if (isset($_GET['file']))
				$current_media_file = $media_files[$_GET['file']];
			else {
				$selected_media = -1;

				foreach ($media_files as $key => $value) {
					if (intval($value['right_preview']) == 1) {
						$selected_media = $key;
						break;
					}
				}
				if ($selected_media == -1 && count($media_files) && isset($media_files[0]))
					$current_media_file = $media_files[0];
				else
					$current_media_file = $media_files[$current_media_file];
			}

		}
		else {
			$title['title'] = CONTENT;
		}

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('ClientBundle/views/content/content.php');
	}

	public function deleteChapterAction() {
		if (isset($_GET['chapter_id'])) {

			$return_value = $this->_chapterManager->removeChapterByIdDb($_GET['chapter_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$_SESSION['flash_message'] = ACTION_SUCCESS;
				header('Location:' . '?page=content&media_id=' . $_GET['media_id']);
				exit;
			}
		}
	}
}