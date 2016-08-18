<?php

require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaExtraFieldLanguageManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/GroupLanguageManager.php');

class MediaExtraFieldController {

	private $_mediaExtraFieldManager;
	private $_organizationManager;
	private $_groupLanguageManager;
	private $_mediaExtraFieldLanguageManager;

	private $_errorArray;

	public function __construct() {
		 $this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		 $this->_organizationManager = new OrganizationManager();
		 $this->_groupLanguageManager = new GroupLanguageManager();
		 $this->_mediaExtraFieldLanguageManager = new MediaExtraFieldLanguageManager();

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
		$mediaExtraField = array();

		if (isset($_POST['id_media_extra_field_mediastorage']) && (strcmp($_POST['id_media_extra_field_mediastorage'], '4894565') == 0)) {
			$mediaExtraField = $this->_mediaExtraFieldManager->formatSelectOrganizationWithPostData();

			header('Location:' . '?page=list_media_extra_field_root&id_organization=' . $mediaExtraField['id_organization']);
			exit;
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = FIELD;

		include ('RootBundle/views/media_extra_field/media_extra_field_select_organization.php');
	}

	public function listAction() {

		$id_organization = $_GET['id_organization'];

		$mediaExtraFields = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsWithOrganizationDb($id_organization);

		$this->mergeErrorArray($mediaExtraFields);

		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . TYPE . '</th>',
				'<th>' . NAME . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($mediaExtraField = $mediaExtraFields['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $mediaExtraField['id'] . '</td>',
					'<td>' . $mediaExtraField['type'] . '</td>',
					'<td>' . $mediaExtraField['name'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_media_extra_field_root&media_extra_field_id=' . $mediaExtraField['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_media_extra_field_root&media_extra_field_id=' . $mediaExtraField['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = MEDIA_INFO_EXTRA_FIELD_LIST_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_list.php');
	}

	public function createAction() {
		$mediaExtraField = array();
		$mediaExtraFieldLanguage = array();

		if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '4894565') == 0)) {
			$mediaExtraField = $this->_mediaExtraFieldManager->formatMediaExtraFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			$mediaExtraFieldLanguage = $this->_mediaExtraFieldLanguageManager->formatMediaExtraFieldLanguageArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraFieldLanguageManager->mediaExtraFieldLanguageCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldCreateDb();
				$this->mergeErrorArray($return_value);
				if (count($this->_errorArray) == 0) {
					$_SESSION['flash_message'] = ACTION_SUCCESS;
					header('Location:' . '?page=list_mediaExtraField_root&id_organization=' . $mediaIfoExtraField['id_organization']);
					exit;
				}
			}
		}

		$id_organization = $_GET['id_organization'];
		$mediaExtraField['id_language'] = $_SESSION['id_language_mediastorage'];

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		$groupLanguages = $this->_groupLanguageManager->getGroupLanguageByOrganizationIdDb($id_organization);
		$this->mergeErrorArray($groupLanguages);

		$title = MEDIA_INFO_EXTRA_FIELD_CREATION_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_create.php');
	}

	public function editAction() {

		$mediaExtraField_data = $this->_mediaExtraFieldManager->getMediaExtraFieldByIdDb($_GET['mediaExtraField_id']);
		$mediaExtraField_data = $this->_mediaExtraFieldManager->getMediaExtraFieldByIdDb($_GET['mediaExtraField_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$roles = $this->_roleManager->getAllRolesDb();
		$languages = $this->_languageManager->getAllLanguagesDb();

		$this->mergeErrorArray($mediaExtraField_data);
		$this->mergeErrorArray($mediaExtraField_data);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($roles);
		$this->mergeErrorArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($mediaExtraField_data_temp = $mediaExtraField_data['data']->fetch_assoc()) {
				$mediaExtraField = $mediaExtraField_data_temp;
			}

			while ($mediaExtraField_data_temp = $mediaExtraField_data['data']->fetch_assoc()) {
				$mediaExtraField_info = $mediaExtraField_data_temp;
			}

			if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '4894565') == 0)) {

				$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldEditAsAdminDb($mediaExtraField);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=list_mediaExtraField_root');
						exit;
					}
				}
			}

			$mediaExtraField = array_merge($mediaExtraField, $mediaExtraField_info);

		}

		$title = USER_EDIT_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_create.php');
	}

	public function deleteAction() {

		if (isset($_GET['mediaExtraField_id'])) {

			$return_value = $this->_mediaExtraFieldManager->removeMediaExtraFieldByIdDb($_GET['media_extra_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}

}
