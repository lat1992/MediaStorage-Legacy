<?php

require_once('CoreBundle/managers/MediaInfoExtraFieldManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/GroupLanguageManager.php');

class MediaInfoExtraFieldController {

	private $_mediaInfoExtraFieldManager;
	private $_organizationManager;
	private $_groupLanguageManager;

	private $_errorArray;

	public function __construct() {
		 $this->_mediaInfoExtraFieldManager = new MediaInfoExtraFieldManager();
		 $this->_organizationManager = new OrganizationManager();
		 $this->_groupLanguageManager = new GroupLanguageManager();

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

	public function selectOrganizationAction() {
		$mediaInfoExtraField = array();

		if (isset($_POST['id_media_info_extra_field_mediastorage']) && (strcmp($_POST['id_media_info_extra_field_mediastorage'], '4894565') == 0)) {
			$mediaInfoExtraField = $this->_mediaInfoExtraFieldManager->formatSelectOrganizationWithPostData();

			header('Location:' . '?page=list_media_info_extra_field_root&id_organization=' . $mediaInfoExtraField['id_organization']);
			exit;
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = FIELD;

		include ('RootBundle/views/media_info_extra_field/media_info_extra_field_select_organization.php');
	}

	public function listAction() {

		$id_organization = $_GET['id_organization'];

		$mediaInfoExtraFields = $this->_mediaInfoExtraFieldManager->getAllMediaInfoExtraFieldsWithOrganizationDb($id_organization);

		$this->mergeErrorArray($mediaInfoExtraFields);

		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . TYPE . '</th>',
				'<th>' . NAME . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($mediaInfoExtraField = $mediaInfoExtraFields['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $mediaInfoExtraField['id'] . '</td>',
					'<td>' . $mediaInfoExtraField['type'] . '</td>',
					'<td>' . $mediaInfoExtraField['name'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_media_info_extra_field_root&media_info_extra_field_id=' . $mediaInfoExtraField['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_media_info_extra_field_root&media_info_extra_field_id=' . $mediaInfoExtraField['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = MEDIA_INFO_EXTRA_FIELD_LIST_TITLE;

		include ('RootBundle/views/media_info_extra_field/media_info_extra_field_list.php');
	}

	public function createAction() {
		$mediaInfoExtraField = array();

		if (isset($_POST['id_media_info_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_field_create_mediastorage'], '4894565') == 0)) {
			$mediaInfoExtraField = $this->_mediaInfoExtraFieldManager->formatMediaInfoExtraFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$_SESSION['flash_message'] = ACTION_SUCCESS;
					header('Location:' . '?page=list_mediaInfoExtraField_root&id_organization=' . $mediaIfoExtraField['id_organization']);
					exit;
				}
			}
		}

		$id_organization = $_GET['id_organization'];
		$mediaInfoExtraField['id_language'] = $_SESSION['id_language_mediastorage'];

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		$groupLanguages = $this->_groupLanguageManager->getGroupLanguageByOrganizationIdDb($id_organization);
		$this->mergeErrorArray($groupLanguages);

		$title = MEDIA_INFO_EXTRA_FIELD_CREATION_TITLE;

		include ('RootBundle/views/media_info_extra_field/media_info_extra_field_create.php');
	}

	public function editAction() {

		$mediaInfoExtraField_data = $this->_mediaInfoExtraFieldManager->getMediaInfoExtraFieldByIdDb($_GET['mediaInfoExtraField_id']);
		$mediaInfoExtraField_info_data = $this->_mediaInfoExtraFieldManager->getMediaInfoExtraFieldInfoByIdDb($_GET['mediaInfoExtraField_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($mediaInfoExtraField_data);
		$this->mergeErrorArray($mediaInfoExtraField_info_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($mediaInfoExtraField_data_temp = $mediaInfoExtraField_data['data']->fetch_assoc()) {
				$mediaInfoExtraField = $mediaInfoExtraField_data_temp;
			}

			while ($mediaInfoExtraField_info_data_temp = $mediaInfoExtraField_info_data['data']->fetch_assoc()) {
				$mediaInfoExtraField_info = $mediaInfoExtraField_info_data_temp;
			}

			if (isset($_POST['id_media_info_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_info_extra_field_create_mediastorage'], '4894565') == 0)) {

				$return_value['error'] = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_mediaInfoExtraFieldManager->mediaInfoExtraFieldEditAsAdminDb($mediaInfoExtraField);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=list_mediaInfoExtraField_root');
						exit;
					}
				}
			}

			$mediaInfoExtraField = array_merge($mediaInfoExtraField, $mediaInfoExtraField_info);

		}

		$title = USER_EDIT_TITLE;

		include ('RootBundle/views/media_info_extra_field/media_info_extra_field_create.php');
	}

	public function deleteAction() {

		if (isset($_GET['mediaInfoExtraField_id'])) {

			$return_value = $this->_mediaInfoExtraFieldManager->removeMediaInfoExtraFieldByIdDb($_GET['media_info_extra_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}

}
