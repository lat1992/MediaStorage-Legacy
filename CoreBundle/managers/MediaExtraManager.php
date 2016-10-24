<?php

require_once('CoreBundle/models/MediaExtra.php');

class MediaExtraManager {

	private $_mediaExtraModel;

	public function __construct() {
		$this->_mediaExtraModel = new MediaExtra();
	}

	public function getAllMediaExtrasDb() {
		return $this->_mediaExtraModel->findAllMediaExtras();
	}

	public function formatMediaExtraArrayWithPostData() {
		$media_extra = array();

		$media_extra['data'] = $_POST['data_mediastorage'];
		$media_extra['id_info'] = $_POST['id_media_info_mediastorage'];
		$media_extra['id_array'] = $_POST['id_media_extra_array_mediastorage'];
		$media_extra['id_field'] = $_POST['id_media_extra_field_mediastorage'];

		return $media_extra;
	}

	public function mediaExtraCreateFormCheck() {
		$error_media_extra = array();

		return $error_media_extra;
	}

	public function mediaExtraCreateDb() {
		return $this->_mediaExtraModel->createNewMediaExtra($_POST);
	}

	public function getMediaExtraByIdDb($media_extra_id) {
		return $this->_mediaExtraModel->findMediaExtraById($media_extra_id);
	}

	public function getMediaExtraByMediaIdAndFieldIdAndIdLanguageDb($id_media, $id_field, $id_language) {
		return $this->_mediaExtraModel->findMediaExtraByMediaIdAndFieldIdAndIdLanguage($id_media, $id_field, $id_language);
	}

	public function getMediaExtraByMediaIdAndFieldIdAndArrayIdDb($id_media, $id_field, $id_array) {
		return $this->_mediaExtraModel->findMediaExtraByMediaIdAndFieldIdAndArrayId($id_media, $id_field, $id_array);
	}

	public function getMediaExtraByMediaIdAndFieldIdDb($id_media, $id_field) {
		return $this->_mediaExtraModel->findMediaExtraByMediaIdAndFieldId($id_media, $id_field);
	}

	public function mediaExtraEditDb($media_extra_data) {
		return $this->_mediaExtraModel->updateMediaExtraWithId($_POST, $media_extra_data['id']);
	}

	public function removeMediaExtraByIdDb($media_extra_id) {
		return $this->_mediaExtraModel->deleteMediaExtraById($media_extra_id);
	}

	public function removeMediaExtraByLanguageIdDb($language_id) {
		return $this->_mediaExtraModel->deleteMediaExtraByLanguageId($language_id);
	}

	public function removeMediaExtraByMediaIdDb($media_id) {
		return $this->_mediaExtraModel->deleteMediaExtraByMediaId($media_id);
	}

	public function removeMediaExtraByArrayIdDb($array_id) {
		return $this->_mediaExtraModel->deleteMediaExtraByArrayId($array_id);
	}

	public function CreateMultipleMediaExtraDb() {
		$post_save = $_POST;

		if (isset($post_save['media_extra_mediastorage'])) {

			foreach ($post_save['media_extra_mediastorage'] as $id_field => $value) {

				$_POST['id_language_mediastorage'] = 'NULL';
				$_POST['id_media_extra_field_mediastorage'] = $id_field;

				if (isset($value['language'])) {

					foreach ($value['language'] as $language => $value2) {

						$_POST['id_language_mediastorage'] = $language;
						$_POST['data_mediastorage'] = $value2['data'];
						$_POST['id_media_extra_array_mediastorage'] = $value2['id_array'];

						$return_value = $this->getMediaExtraByMediaIdAndFieldIdAndIdLanguageDb($_POST['id_media_mediastorage'], $id_field, $language);

						if (!empty($return_value['error'])) {
							return $return_value;
						}

						if ($return_value['data']->num_rows == 0) {

							$return_value = $this->mediaExtraCreateDb();

							if (!empty($return_value['error'])) {
								return $return_value;
							}
						}

						else {
							$media_extra = $return_value['data']->fetch_assoc();

							$return_value = $this->mediaExtraEditDb($media_extra);

							if (!empty($return_value['error'])) {
								return $return_value;
							}
						}

						// $return_value = $this->mediaExtraCreateDb();

						// if (!empty($return_value['error'])) {
						// 	return $return_value;
						// }
					}
				}
				elseif (isset($value['multiple'])) {

					foreach ($value['multiple'] as $value2) {

						$_POST['data_mediastorage'] = $value2['data'];
						$_POST['id_media_extra_array_mediastorage'] = $value2['id_array'];

						$return_value = $this->getMediaExtraByMediaIdAndFieldIdAndArrayIdDb($_POST['id_media_mediastorage'], $id_field, $value2['id_array']);

						if ($return_value['data']->num_rows == 0) {

							$return_value = $this->mediaExtraCreateDb();

							if (!empty($return_value['error'])) {
								return $return_value;
							}
						}

						else {
							$media_extra = $return_value['data']->fetch_assoc();

							$return_value = $this->mediaExtraEditDb($media_extra);

							if (!empty($return_value['error'])) {
								return $return_value;
							}
						}

						// $return_value = $this->mediaExtraCreateDb();

						// if (!empty($return_value['error'])) {
						// 	return $return_value;
						// }
					}
				}
				else {
					$_POST['data_mediastorage'] = $value['data'];
					$_POST['id_media_extra_array_mediastorage'] = $value['id_array'];

					$return_value = $this->getMediaExtraByMediaIdAndFieldIdDb($_POST['id_media_mediastorage'], $id_field);

					if ($return_value['data']->num_rows == 0) {

						$return_value = $this->mediaExtraCreateDb();

						if (!empty($return_value['error'])) {
							return $return_value;
						}
					}

					else {
						$media_extra = $return_value['data']->fetch_assoc();

						$return_value = $this->mediaExtraEditDb($media_extra);

						if (!empty($return_value['error'])) {
							return $return_value;
						}
					}

					// $return_value = $this->mediaExtraCreateDb();

					// if (!empty($return_value['error'])) {
					// 	return $return_value;
					// }
				}
			}

		}
		$_POST = $post_save;

		return NULL;
	}

	public function getMediaExtraByMediaIdDb($id_media) {
		return $this->_mediaExtraModel->findMediaExtraByMediaId($id_media);
	}

	public function formatMediaExtraDataForView($media_extras_data) {
		$return_data = array();

		foreach ($media_extras_data as $row) {

			// $return_data[$row['id_field']] = $row;

			if (strcmp($row['type'], 'Text') == 0) {
				$return_data[$row['id_field']]['language'][$row['id_language']]['data'] = $row['data'];
			}

			if (strcmp($row['type'], 'Date') == 0) {
				$return_data[$row['id_field']]['data'] = $row['data'];
			}

			if (strcmp($row['type'], 'Array_multiple') == 0) {
				$return_data[$row['id_field']]['multiple'][]['id_array'] = $row['id_array'];
			}

			if (strcmp($row['type'], 'Array_unique') == 0) {
				$return_data[$row['id_field']]['id_array'] = $row['id_array'];
			}

			if (strcmp($row['type'], 'Boolean') == 0) {
				$return_data[$row['id_field']]['data'] = $row['data'];
			}
		}

		return $return_data;
	}

	public function formatMediaExtraDataWithPostData() {
		if (isset($_POST['media_extra_mediastorage']))
			return $_POST['media_extra_mediastorage'];
		return array();
	}
}