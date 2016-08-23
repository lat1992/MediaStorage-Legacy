<?php

require_once('CoreBundle/models/Media.php');

class MediaManager {

	private $_mediaModel;

	public function __construct() {
		$this->_mediaModel = new Media();
	}

	public function getAllMediasDb() {
		return $this->_mediaModel->findAllMedias();
	}

	public function getAllProgramsByIdOrganizationDb() {
		return $this->_mediaModel->findAllmediasByIdOrganizationAndIdType($_SESSION['id_organization'], 1);
	}

	public function getAllContentsByIdOrganizationDb() {
		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdType($_SESSION['id_organization'], 2);
	}

	public function getAllProgramsByIdOrganizationAndFolderIdDb($id_folder) {
		return $this->_mediaModel->findAllMediasByIdOrganizationAndFolderId($_SESSION['id_organization'], $id_folder);
	}

	public function getAllContentsByIdOrganizationAndParentIdDb($id_parent) {
		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdTypeAndParentId($_SESSION['id_organization'], 2, $id_parent);
	}

	public function getAllProgramsWithoutParentsByOrganizationDb() {
		return $this->_mediaModel->findAllMediasWithoutParentsByIdOrganizationAndIdType($_SESSION['id_organization'], 1);
	}

	public function formatMediaArrayWithPostData() {
		$media = array();

		$media['id_type'] = $_POST['id_type_mediastorage'];
		$media['reference'] = $_POST['reference_mediastorage'];
		$media['reference_client'] = $_POST['reference_client_mediastorage'];
		$media['right_view'] = $_POST['right_view_mediastorage'];
		$media['handover_date'] = $_POST['handover_date_mediastorage'];

		return $media;
	}

	// public function mediaCreateFormCheck() {
	// 	$error_media = array();

	// 	if (strlen($_POST['reference_mediastorage']) == 0) {
	// 		$error_media[] = EMPTY_MEDIA_REFERENCE;
	// 	}
	// 	if (strlen($_POST['reference_mediastorage']) > 50) {
	// 		$error_media[] = INVALID_MEDIA_REFERENCE_TOO_LONG;
	// 	}

	// 	return $error_media;
	// }

	public function mediaCreateDb() {

		if (!empty($_POST['handover_date_mediastorage'])) {
			$temp = new DateTime($_POST['handover_date_mediastorage']);
			$handover_date = $temp->format('Y-m-d H:i:s');
			$_POST['handover_date_mediastorage'] = $handover_date;
		}

		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

		$_POST['created_date_mediastorage'] = $created_date;
		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaModel->createNewMedia($_POST);
	}

	public function getMediaByIdDb($media_id) {
		return $this->_mediaModel->findMediaByid($media_id);
	}

	public function getMediaByIdAndOrganizationIdDb($id_media) {
		return $this->_mediaModel->findMediaByidAndOrganizationId($id_media, $_SESSION['id_organization']);
	}

	public function mediaEditDb($media_data) {
		return $this->_mediaModel->updateMediaWithId($_POST, $media_data['id']);
	}

	public function checkAndMediaEditDb($media_data) {
		if (strcmp($_POST['id_folder_mediastorage'], 'NULL') == 0)
			$_POST['id_folder_mediastorage'] = $media_data['id_folder'];

		if (strcmp($_POST['id_parent_mediastorage'], 'NULL') == 0)
			$_POST['id_parent_mediastorage'] = $media_data['id_parent'];

		if (!empty($_POST['handover_date_mediastorage'])) {
			$temp = new DateTime($_POST['handover_date_mediastorage']);
			$handover_date = $temp->format('Y-m-d H:i:s');
			$_POST['handover_date_mediastorage'] = $handover_date;
		}

		$modified_date = date('Y-m-d H:i:s');

		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaModel->updateMediaWithId($_POST, $media_data['id']);
	}

	public function removeMediaByIdDb($media_id) {
		//$data = $this->_mediaInfoManager->deleteMediaInfoByMediaId($media_id);
		if (!empty($data['error']))
			return $data;

		return $this->_mediaModel->deleteMediaById($media_id);
	}

	public function ajaxGetMediaByParentIdDb($parent_id) {
		return $this->_mediaModel->findAllMediaWithParentIdAndOrganization($parent_id, $_SESSION['id_organization']);
	}

	public function preFillMediaPostData($id_type) {

		$folder = NULL;

		foreach ($_POST['id_folder_mediastorage'] as $data_folder) {
			if ($data_folder)
				$folder = $data_folder;
		}
		if ($folder == NULL)
			$folder = 'NULL';

		$parent = NULL;

		if (isset($_POST['id_parent_mediastorage'])) {
			foreach ($_POST['id_parent_mediastorage'] as $data_parent) {
				if ($data_parent)
					$parent = $data_parent;
			}
		}
		if ($parent == NULL)
			$parent = 'NULL';

		$right_view = intval($_POST['right_view_mediastorage']);

		$reference = $this->getLastReferenceNumberByOrganizationDb();
		if (!empty($reference['error']))
			return $reference;

		$reference = $reference['data']->fetch_assoc();

		$_POST['reference_mediastorage'] = intval($reference['reference']) + 1;
		$_POST['right_view_mediastorage'] = $right_view;
		$_POST['id_folder_mediastorage'] = $folder;
		$_POST['id_parent_mediastorage'] = $parent;
		$_POST['id_type_mediastorage'] = $id_type;
		$_POST['id_organization_mediastorage'] = $_SESSION['id_organization'];
	}

	public function mediaCreateFormCheck() {
		$errors = array();

		if (strlen($_POST['reference_client_mediastorage']) == 0) {
			$error_media[] = EMPTY_MEDIA_REFERENCE;
		}
		if (strlen($_POST['reference_client_mediastorage']) > 10) {
			$error_media[] = INVALID_MEDIA_REFERENCE_TOO_LONG;
		}

		foreach ($_POST['title_mediastorage'] as $key => $value) {

			if ( strlen($_POST['title_mediastorage'][$key]) == 0 &&
				strlen($_POST['subtitle_mediastorage'][$key]) == 0 &&
				strlen($_POST['description_mediastorage'][$key]) == 0 &&
				strlen($_POST['episode_number_mediastorage'][$key]) == 0 &&
				strlen($_POST['image_version_mediastorage'][$key]) == 0 &&
				strlen($_POST['sound_version_mediastorage'][$key]) == 0
			) {
				unset($_POST['title_mediastorage'][$key]);
				unset($_POST['subtitle_mediastorage'][$key]);
				unset($_POST['description_mediastorage'][$key]);
				unset($_POST['episode_number_mediastorage'][$key]);
				unset($_POST['image_version_mediastorage'][$key]);
				unset($_POST['sound_version_mediastorage'][$key]);
			}
		}

		if (isset($_POST['media_extra_mediastorage'])) {
			foreach ($_POST['media_extra_mediastorage'] as $media_extra_key => $media_extra) {

				if (isset($media_extra['data'])) {
					$_POST['media_extra_mediastorage'][$media_extra_key]['id_array'] = 'NULL';
					if (strlen($media_extra['data']) == 0)
						unset($_POST['media_extra_mediastorage'][$media_extra]);
				}
				elseif (isset($media_extra['id_array'])) {
					$_POST['media_extra_mediastorage'][$media_extra_key]['data'] = 'NULL';
					if (strlen($media_extra['id_array']) == 0)
						unset($_POST['media_extra_mediastorage'][$media_extra]);
				}
				elseif (isset($media_extra['language'])) {

					foreach ($media_extra['language'] as $key => $value) {

						if (isset($value['data'])) {
							$_POST['media_extra_mediastorage'][$media_extra_key]['language'][$key]['id_array'] = 'NULL';
							if (strlen($value['data']) == 0)
								unset($_POST['media_extra_mediastorage'][$media_extra_key]['language'][$key]);
						}
					}

				}
				elseif (isset($media_extra['multiple'])) {

					foreach ($media_extra['multiple'] as $key => $value) {

						if (isset($value['id_array'])) {
							$_POST['media_extra_mediastorage'][$media_extra_key]['multiple'][$key]['data'] = 'NULL';
							if (strlen($value['id_array']) == 0)
								unset($_POST['media_extra_mediastorage'][$media_extra_key]['multiple'][$key]);
						}
					}

				}
			}
		}

		return $errors;
	}

	public function getLastReferenceNumberByOrganizationDb() {
		return $this->_mediaModel->findLastRefenceNumberByOrganization($_SESSION['id_organization']);
	}
}