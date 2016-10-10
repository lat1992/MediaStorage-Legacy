<?php

require_once('CoreBundle/models/MediaExtraArray.php');
require_once('CoreBundle/managers/ToolboxManager.php');

require_once('CoreBundle/managers/MediaExtraFieldManager.php');

class MediaExtraArrayManager {

	private $_mediaExtraArrayModel;

	private $_mediaExtraFieldManager;
	private $_toolboxManager;

	public function __construct() {
		$this->_mediaExtraArrayModel = new MediaExtraArray();

		$this->_mediaExtraFieldManager = new MediaExtraField();
		$this->_toolboxManager = new ToolboxManager();
	}

	public function getAllMediaExtraArraysDb() {
		return $this->_mediaExtraArrayModel->findAllMediaExtraArrays();
	}

	public function formatMediaExtraArrayArrayWithPostData() {
		$media_extra_array = array();

		$media_extra_array['element'] = $_POST['element_mediastorage'];
		$media_extra_array['id_media_extra_field'] = $_POST['id_media_extra_field_mediastorage'];

		return $media_extra_array;
	}

	public function media_extra_arrayCreateFormCheck() {
		$error_media_extra_array = array();

		if (strlen($_POST['element_mediastorage']) == 0) {
			$error_media_extra_array[] = EMPTY_ELEMENT;
		}
		if (strlen($_POST['element_mediastorage']) > 50) {
			$error_media_extra_array[] = INVALID_ELEMENT_TOO_LONG;
		}

		return $error_media_extra_array;
	}

	public function createMultipleExtraArray() {
		$data = array();

		foreach ($_POST['media_extra_field_array_data_mediastorage'] as $main_key => $mediaExtraArrayData) {

			foreach ($mediaExtraArrayData as $key => $mediaExtraArray) {

				$data['element_mediastorage'] = $mediaExtraArray;
				$data['id_media_extra_field_mediastorage'] = $_POST['id_media_extra_field_mediastorage'];
				$data['id_language'] = $key;
				$data['id_order'] = $main_key;

				$result = $this->getMediaExtraArrayByIdFieldAndIdLanguageAndIdOrderDb($data['id_media_extra_field_mediastorage'], $data['id_language'], $data['id_order']);
				if ($result['data']->num_rows == 0) {
					$this->_mediaExtraArrayModel->createNewMediaExtraArray($data);
				}
				else {
					$temp = $result['data']->fetch_assoc();
					$this->_mediaExtraArrayModel->updateMediaExtraArrayWithId($data, $temp['id']);
				}
			}
		}
	}

	public function mediaExtraArrayCreateDb() {
		return $this->_mediaExtraArrayModel->createNewMediaExtraArray($_POST);
	}

	public function getMediaExtraArrayByIdDb($media_extra_array_id) {
		return $this->_mediaExtraArrayModel->findMediaExtraArrayById($media_extra_array_id);
	}

	public function mediaExtraArrayEditDb($media_extra_array_data) {
		return $this->_mediaExtraArrayModel->updateMediaExtraArrayWithId($_POST, $media_extra_array_data['id']);
	}

	public function removeMediaExtraArrayByIdDb($media_extra_array_id) {
		// $data = $this->_mediaExtraFieldManager->deleteMediaExtraFieldByMediaExtraArrayId($media_extra_array_id);
		// if (!empty($data['error']))
		// 	return $data;

		return $this->_mediaExtraArrayModel->deleteMediaExtraArrayById($media_extra_array_id);
	}

	public function removeMediaExtraArrayByIdFieldAndIdOrderDb($id_field, $id_order) {
		return $this->_mediaExtraArrayModel->deleteMediaExtraArrayByIdFieldAndIdOrder($id_field, $id_order);
	}

	public function getMediaExtraArrayByIdFieldDb($id_field) {
		return $this->_mediaExtraArrayModel->findMediaExtraArrayByIdField($id_field);
	}

	public function getMediaExtraArrayByIdFieldAndIdLanguageAndIdOrderDb($id_field, $id_language, $id_order) {
		return $this->_mediaExtraArrayModel->findMediaExtraArrayByIdFieldAndIdLanguageAndIdOrder($id_field, $id_language, $id_order);
	}

	public function formatDataForView($mediaExtraArrayData) {
		$return_array = array();

		$mediaExtraArrayData = $this->_toolboxManager->mysqliResultToArray($mediaExtraArrayData);

		foreach ($mediaExtraArrayData as $mediaExtraArray) {
			$return_array[$mediaExtraArray['id_order']][$mediaExtraArray['id_language']] = $mediaExtraArray['element'];
		}

		return $return_array;
	}
}