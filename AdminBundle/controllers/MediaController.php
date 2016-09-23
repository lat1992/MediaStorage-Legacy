<?php

require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/MediaInfoManager.php');
require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');

class MediaController {

	private $_mediaManager;
	private $_mediaExtraManager;
	private $_mediaInfoManager;
	private $_folderManager;
	private $_mediaFileManager;
	private $_languageManager;
	private $_mediaExtraFieldManager;
	private $_toolboxManager;
	private $_designManager;

	private $_errorArray;

	public function __construct() {
		$this->_mediaManager = new MediaManager();
		$this->_mediaExtraManager = new MediaExtraManager();
		$this->_mediaInfoManager = new MediaInfoManager();
		$this->_folderManager = new FolderManager();
		$this->_mediaFileManager = new MediaFileManager();
		$this->_languageManager = new LanguageManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();

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

	public function listProgramAction() {
		$medias = $this->_mediaManager->getAllProgramsByIdOrganizationDb();

		$this->mergeErrorArray($medias);

		$table_header = array(
				'<th>' . REFERENCE . '</th>',
				'<th>' . REFERENCE_CLIENT . '</th>',
				'<th>' . RIGHT_VIEW . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($media = $medias['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $media['reference'] . '</td>',
					'<td>' . $media['reference_client'] . '</td>',
					'<td>' . $media['right_view'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_program_admin&media_id=' . $media['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_programmau_admin&media_id=' . $media['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = PROGRAM_LIST_TITLE;

		include ('AdminBundle/views/media/program_list.php');
	}

	public function listContentAction() {
		$medias = $this->_mediaManager->getAllContentsByIdOrganizationDb();

		$this->mergeErrorArray($medias);

		$table_header = array(
				'<th>' . REFERENCE . '</th>',
				'<th>' . REFERENCE_CLIENT . '</th>',
				'<th>' . RIGHT_VIEW . '</th>',
				'<th></th>',
				(isset($_SESSION['permits'][PERMIT_DELETE_CONTENT])) ? '<th></th>' : '',
			);

		$table_data = array();

		if (count($this->_errorArray) == 0) {

			while ($media = $medias['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $media['reference'] . '</td>',
					'<td>' . $media['reference_client'] . '</td>',
					'<td>' . $media['right_view'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_content_admin&media_id=' . $media['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					(isset($_SESSION['permits'][PERMIT_DELETE_CONTENT])) ? '<td class="button_td delete" ><a href="?page=delete_contentmau_admin&media_id=' . $media['id'] . '" class="button_a delete">' . DELETE . '</a></td>' : '',
				);
			}

		}

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = CONTENT_LIST_TITLE;

		include ('AdminBundle/views/media/content_list.php');
	}

	public function createProgramAction() {
		$media = array();
		$languages = null;

		if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {
// var_dump($_POST);exit;
			$return_value = $this->_mediaManager->preFillMediaPostData(1);
			$this->mergeErrorArray($return_value);

			$return_value = $this->_mediaManager->mediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			$media = $this->_mediaManager->formatMediaArrayWithPostData();
			$media_infos = $this->_mediaInfoManager->formatMediaInfoDataWithPostData();
			$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataWithPostData();

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_mediaManager->mediaCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_media_mediastorage'] = $return_value['id'];

					$return_value = $this->_mediaInfoManager->CreateMultipleMediaInfoDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$return_value = $this->_mediaExtraManager->CreateMultipleMediaExtraDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {

							$return_value = $this->_mediaFileManager->updateMultipleMediaFilesDb();
							$this->mergeErrorArray($return_value);

							if (count($this->_errorArray) == 0) {
								$_SESSION['flash_message'] = ACTION_SUCCESS;
								header('Location:' . '?page=list_program_admin');
								exit;
							}
						}
					}
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$enums = $this->_mediaFileManager->getEnumOfTypeDb();
		$languages_data = $this->_languageManager->getAllLanguagesByGroupDb();
		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(1);
		$media_files = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($enums);
		$this->mergeErrorArray($languages_data);
		$this->mergeErrorArray($media_extra_data);
		$this->mergeErrorArray($media_files);

		$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

		$enums = $enums['data'];

		$languages = $this->_toolboxManager->mysqliResultToArray($languages_data);

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = CREATE_MEDIA_PROGRAM;

		include ('AdminBundle/views/media/media_create_program.php');
	}

	public function createContentAction() {
		$media = array();
		$languages = null;

		if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {

			$return_value = $this->_mediaManager->preFillMediaPostData(2);
			$this->mergeErrorArray($return_value);

			$return_value = $this->_mediaManager->mediaCreateFormCheck();
			$this->mergeErrorArray($return_value);

			$media = $this->_mediaManager->formatMediaArrayWithPostData();
			$media_infos = $this->_mediaInfoManager->formatMediaInfoDataWithPostData();
			$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataWithPostData();

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_mediaManager->mediaCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_media_mediastorage'] = $return_value['id'];

					$return_value = $this->_mediaInfoManager->CreateMultipleMediaInfoDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$return_value = $this->_mediaExtraManager->CreateMultipleMediaExtraDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {

							$return_value = $this->_mediaFileManager->updateMultipleMediaFilesDb();
							$this->mergeErrorArray($return_value);

							if (count($this->_errorArray) == 0) {
								$_SESSION['flash_message'] = ACTION_SUCCESS;
								header('Location:' . '?page=list_content_admin');
								exit;
							}
						}


					}
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$enums = $this->_mediaFileManager->getEnumOfTypeDb();
		$languages_data = $this->_languageManager->getAllLanguagesByGroupDb();
		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
		$parents = $this->_mediaManager->getAllProgramsByIdOrganizationDb();
		$media_files = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($enums);
		$this->mergeErrorArray($languages_data);
		$this->mergeErrorArray($media_extra_data);
		$this->mergeErrorArray($media_files);

		$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

		$enums = $enums['data'];

		$languages = $this->_toolboxManager->mysqliResultToArray($languages_data);

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = CREATE_MEDIA_CONTENT;

		include ('AdminBundle/views/media/media_create_content.php');
	}


	public function editProgramAction() {
		$media = array();
		$languages = null;

		$media_data = $this->_mediaManager->getMediaByIdAndOrganizationIdDb($_GET['media_id']);

		$this->mergeErrorArray($media_data);

		if (count($this->_errorArray) == 0) {

			$media = $this->_toolboxManager->mysqliResultToData($media_data);

			if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {

				$return_value = $this->_mediaManager->preFillMediaPostData(1);
				$this->mergeErrorArray($return_value);
				$return_value = $this->_mediaManager->mediaCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_mediaManager->checkAndMediaEditDb($media);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$_POST['id_media_mediastorage'] = $_GET['media_id'];

						$return_value = $this->_mediaInfoManager->CreateMultipleMediaInfoDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {

							$return_value = $this->_mediaExtraManager->CreateMultipleMediaExtraDb();
							$this->mergeErrorArray($return_value);

							if (count($this->_errorArray) == 0) {

								$return_value = $this->_mediaFileManager->updateMultipleMediaFilesDb();
								$this->mergeErrorArray($return_value);

								if (count($this->_errorArray) == 0) {
									$_SESSION['flash_message'] = ACTION_SUCCESS;
									header('Location:' . '?page=list_program_admin');
									exit;
								}
							}
						}
					}
				}
			}
		}

		$media_infos_data = $this->_mediaInfoManager->getMediaInfoByMediaIdDb($_GET['media_id']);
		$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($_GET['media_id']);

		$this->mergeErrorArray($media_infos_data);
		$this->mergeErrorArray($media_extras_user_data);

		$media_infos = $this->_toolboxManager->mysqliResultToArray($media_infos_data);

		$media_infos = $this->_mediaInfoManager->getArrayWithIdLanguageKey($media_infos);

		$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);

		$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$enums = $this->_mediaFileManager->getEnumOfTypeDb();
		$languages_data = $this->_languageManager->getAllLanguagesByGroupDb();
		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(1);
		$media_files = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($enums);
		$this->mergeErrorArray($languages_data);
		$this->mergeErrorArray($media_extra_data);
		$this->mergeErrorArray($media_files);

		$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

		$enums = $enums['data'];

		$languages = $this->_toolboxManager->mysqliResultToArray($languages_data);

		$title = EDIT_MEDIA_PROGRAM;

		include ('AdminBundle/views/media/media_create_program.php');
	}

	public function editContentAction() {
		$media = array();
		$languages = null;

		$media_data = $this->_mediaManager->getMediaByIdAndOrganizationIdDb($_GET['media_id']);

		$this->mergeErrorArray($media_data);

		if (count($this->_errorArray) == 0) {

			$media = $this->_toolboxManager->mysqliResultToData($media_data);

			if (isset($_POST['id_media_create_mediastorage']) && (strcmp($_POST['id_media_create_mediastorage'], '895143') == 0)) {

				$return_value = $this->_mediaManager->preFillMediaPostData(2);
				$this->mergeErrorArray($return_value);

				$return_value = $this->_mediaManager->mediaCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_mediaManager->checkAndMediaEditDb($media);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$_POST['id_media_mediastorage'] = $_GET['media_id'];

						$return_value = $this->_mediaInfoManager->CreateMultipleMediaInfoDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {

							$return_value = $this->_mediaExtraManager->CreateMultipleMediaExtraDb();
							$this->mergeErrorArray($return_value);

							if (count($this->_errorArray) == 0) {

								$return_value = $this->_mediaFileManager->updateMultipleMediaFilesDb();
								$this->mergeErrorArray($return_value);

								if (count($this->_errorArray) == 0) {
									$_SESSION['flash_message'] = ACTION_SUCCESS;
									header('Location:' . '?page=list_content_admin');
									exit;
								}
							}
						}
					}
				}
			}
		}

		$media_infos_data = $this->_mediaInfoManager->getMediaInfoByMediaIdDb($_GET['media_id']);
		$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($_GET['media_id']);

		$this->mergeErrorArray($media_infos_data);
		$this->mergeErrorArray($media_extras_user_data);

		$media_infos = $this->_toolboxManager->mysqliResultToArray($media_infos_data);

		$media_infos = $this->_mediaInfoManager->getArrayWithIdLanguageKey($media_infos);

		$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);

		$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$enums = $this->_mediaFileManager->getEnumOfTypeDb();
		$languages_data = $this->_languageManager->getAllLanguagesByGroupDb();
		$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
		$parents = $this->_mediaManager->getAllProgramsByIdOrganizationDb();
		$media_files = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();
		$media_files_linked = $this->_mediaFileManager->getAllMediaFilesByMediaIdDb($_GET['media_id']);

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($enums);
		$this->mergeErrorArray($languages_data);
		$this->mergeErrorArray($media_extra_data);
		$this->mergeErrorArray($media_files);
		$this->mergeErrorArray($media_files_linked);

		$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

		$enums = $enums['data'];

		$languages = $this->_toolboxManager->mysqliResultToArray($languages_data);

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = EDIT_MEDIA_CONTENT;
		include ('AdminBundle/views/media/media_create_content.php');
	}

	// public function deleteAction() {
	// 	if (isset($_GET['media_id'])) {

	// 		$return_value = $this->_mediaManager->removeMediaByIdDb($_GET['media_id']);
	// 		$this->mergeErrorArray($return_value);

	// 		if (count($this->_errorArray) == 0) {
	// 			header('Location:' . '?page=dashboard');
		// 		}
	// 	}

	// 	include ('CoreBundle/views/common/error.php');
	// }

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