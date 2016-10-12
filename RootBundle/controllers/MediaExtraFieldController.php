<?php

require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaExtraArrayManager.php');
require_once('CoreBundle/managers/MediaExtraFieldLanguageManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/GroupLanguageManager.php');
require_once('CoreBundle/managers/MediaTypeManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/MediaTypeFieldManager.php');

class MediaExtraFieldController {

	private $_mediaExtraFieldManager;
	private $_mediaExtraArrayManager;
	private $_mediaExtraFieldLanguageManager;
	private $_organizationManager;
	private $_groupLanguageManager;
	private $_mediaTypeManager;
	private $_mediaTypeFieldManager;
	private $_toolboxManager;

	private $_errorArray;

	public function __construct() {
		 $this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		 $this->_mediaExtraArrayManager = new MediaExtraArrayManager();
		 $this->_organizationManager = new OrganizationManager();
		 $this->_groupLanguageManager = new GroupLanguageManager();
		 $this->_mediaExtraFieldLanguageManager = new MediaExtraFieldLanguageManager();
		 $this->_mediaTypeManager = new MediaTypeManager();
		 $this->_mediaTypeFieldManager = new MediaTypeFieldManager();
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

	public function selectOrganizationAction() {
		$mediaExtraField = array();

		if (isset($_POST['id_select_mediastorage']) && (strcmp($_POST['id_select_mediastorage'], '4894565') == 0)) {
			$mediaExtraField = $this->_mediaExtraFieldManager->formatSelectOrganizationWithPostData();

			header('Location:' . '?page=list_media_extra_field_root&id_organization=' . $mediaExtraField['id_organization']);
			exit;
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = MEDIA_EXTRA_FIELD_LIST_TITLE;

		include ('RootBundle/views/common/select_organization.php');
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

		$title = MEDIA_EXTRA_FIELD_LIST_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_list.php');
	}

	public function createAction() {
		$mediaExtraField = array();

		if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '4894565') == 0)) {
			$mediaExtraField = $this->_mediaExtraFieldManager->formatMediaExtraFieldArrayWithPostData();
			$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldCreateDb();
				$this->mergeErrorArray($return_value);
				$_POST['id_field_mediastorage'] = $return_value['id'];

				if (count($this->_errorArray) == 0) {
					foreach ($_POST['media_extra_field_language_data_mediastorage'] as $key => $value) {
						$return_value = $this->_mediaExtraFieldLanguageManager->mediaExtraFieldLanguageCreateDb($_POST['id_field_mediastorage'], $key, $value);
						$this->mergeErrorArray($return_value);
					}
					if (count($this->_errorArray) == 0) {

						$_POST['id_type_mediastorage'] = $_POST['id_mediatype_mediastorage'];
						$_POST['id_media_extra_field_mediastorage'] = $_POST['id_field_mediastorage'];

						$this->_mediaTypeFieldManager->mediaTypeFieldCreateDb();

						if (count($this->_errorArray) == 0) {

							$this->_mediaExtraArrayManager->createMultipleExtraArray();

							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_media_extra_field_root&id_organization=' . $_GET['id_organization']);
							exit;
						}
					}
				}
			}
		}

		$id_organization = $_GET['id_organization'];
		$mediaExtraField['id_language'] = $_SESSION['id_language_mediastorage'];

		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$this->mergeErrorArray($organizations);

		$groupLanguages = $this->_groupLanguageManager->getGroupLanguageByOrganizationIdDb($id_organization);
		$this->mergeErrorArray($groupLanguages);
		$groupLanguages = $this->_toolboxManager->mysqliResultToArray($groupLanguages);

		$mediaTypes_data = $this->_mediaTypeManager->getAllMediaTypesDb();
		$mediaTypes = $this->_toolboxManager->mysqliResultToArray($mediaTypes_data);

		$title = MEDIA_EXTRA_FIELD_CREATION_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_create.php');
	}

	public function editAction() {
		$mediaExtraFields = $this->_mediaExtraFieldManager->getMediaExtraFieldByIdDb($_GET['media_extra_field_id']);
		$organizations = $this->_organizationManager->getAllOrganizationsDb();
		$id_organization = $mediaExtraFields['id_organization'];
		$groupLanguages = $this->_groupLanguageManager->getGroupLanguageByOrganizationIdDb($id_organization);
		$mediaExtraFieldLanguages = $this->_mediaExtraFieldLanguageManager->getMediaExtraFieldLanguagesDb($_GET['media_extra_field_id']);
		$mediaTypes_data = $this->_mediaTypeManager->getAllMediaTypesDb();
		$mediaTypes = $this->_toolboxManager->mysqliResultToArray($mediaTypes_data);
		$mediaTypeFieldData = $this->_mediaTypeFieldManager->getMediaTypeFieldByIdFieldDb($_GET['media_extra_field_id']);
		$mediaTypeField = $this->_toolboxManager->mysqliResultToData($mediaTypeFieldData);
		$mediaExtraArray = $this->_mediaExtraArrayManager->getMediaExtraArrayByIdFieldDb($_GET['media_extra_field_id']);
		$mediaExtraArray = $this->_mediaExtraArrayManager->formatDataForView($mediaExtraArray);
		$this->mergeErrorArray($mediaExtraFields);
		$this->mergeErrorArray($organizations);
		$this->mergeErrorArray($groupLanguages);
		$this->mergeErrorArray($mediaExtraFieldLanguages);

		$groupLanguages = $this->_toolboxManager->mysqliResultToArray($groupLanguages);

		if (count($this->_errorArray) == 0) {
			while ($mediaExtraField_temp = $mediaExtraFields['data']->fetch_assoc()) {
				$mediaExtraField = $mediaExtraField_temp;
			}
			while ($mediaExtraFieldLanguage_temp = $mediaExtraFieldLanguages['data']->fetch_assoc()) {
				$mediaExtraFieldLanguage[$mediaExtraFieldLanguage_temp['id_language']] = $mediaExtraFieldLanguage_temp;
			}

			if (isset($_POST['id_media_extra_field_create_mediastorage']) && (strcmp($_POST['id_media_extra_field_create_mediastorage'], '4894565') == 0)) {

				$return_value['error'] = $this->_mediaExtraFieldManager->mediaExtraFieldEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_mediaExtraFieldManager->mediaExtraFieldEditDb($mediaExtraField['id'], $_POST);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						foreach ($_POST['media_extra_field_language_data_mediastorage'] as $key => $value) {
							$return_value = $this->_mediaExtraFieldLanguageManager->mediaExtraFieldLanguageEditDb($mediaExtraField['id'], $key, $value);
							$this->mergeErrorArray($return_value);
						}

						$this->_mediaTypeFieldManager->mediaTypeFieldEditByIdFieldDb($_GET['media_extra_field_id']);

						if (count($this->_errorArray) == 0) {
							$_POST['id_media_extra_field_mediastorage'] = $_GET['media_extra_field_id'];
							$this->_mediaExtraArrayManager->createMultipleExtraArray();

							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_media_extra_field_root&id_organization='. $id_organization);
							exit;
						}
					}
				}
			}

		}

		$title = USER_EDIT_TITLE;

		include ('RootBundle/views/media_extra_field/media_extra_field_create.php');
	}

	public function deleteAction() {
/*
		if (isset($_GET['mediaExtraField_id'])) {

			$return_value = $this->_mediaExtraFieldManager->removeMediaExtraFieldByIdDb($_GET['media_extra_field_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');*/
	}

	public function deleteExtraArrayAction() {

		if (isset($_GET['id_order'])) {
			$this->_mediaExtraArrayManager->removeMediaExtraArrayByIdFieldAndIdOrderDb($_GET['media_extra_field_id'], $_GET['id_order']);
		}

		header('Location:' . '?page=edit_media_extra_field_root&media_extra_field_id='. $_GET['media_extra_field_id']);
		exit;
	}

}
