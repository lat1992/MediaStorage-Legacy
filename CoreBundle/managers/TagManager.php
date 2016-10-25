<?php

require_once('CoreBundle/models/Tag.php');
require_once('CoreBundle/models/TagLanguage.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class TagManager {

	private $_tagModel;
	private $_tagLamguageModel;
	private $_toolboxManager;

	public function __construct() {
		$this->_tagModel = new Tag();
		$this->_tagLanguageModel = new TagLanguage();
		$this->_toolboxManager = new ToolboxManager();
	}

	public function getAllTagsWithTagLanguageAndLanguageDb() {
		return $this->_tagModel->findAllTagsWithTagLanguageAndLanguage();
	}

	public function getAllTagsDb() {
		return $this->_tagModel->findAllTags();
	}

	public function formatTagArrayWithPostData() {
		$tag = array();

		$tag['tag'] = $_POST['tag_mediastorage'];
		$tag['id_media'] = $_POST['id_media_mediastorage'];

		return $tag;
	}

	public function tagCreateFormCheck() {
		$error_tag = array();

		if (strlen($_POST['tag_mediastorage']) == 0) {
			$error_tag[] = EMPTY_TAG;
		}
		if (strlen($_POST['tag_mediastorage']) > 20) {
			$error_tag[] = INVALID_TAG_TOO_LONG;
		}

		return $error_tag;
	}

	public function tagCreateDb() {
		return $this->_tagModel->createNewTag($_POST);
	}

	public function getTagByIdDb($tag_id) {
		return $this->_tagModel->findTagById($tag_id);
	}

	public function tagEditDb($tag_data) {
		return $this->_tagModel->updateTagWithId($_POST, $tag_data['id']);
	}

	public function removeTagByIdDb($tag_id) {
		return $this->_tagModel->deleteTagById($tag_id);
	}

	public function removeTagByMediaDb($media_id) {
		return $this->_tagModel->deleteTagByMediaId($media_id);
	}

	public function createOrDeleteMultipleTagDb() {
		$media_id = $_POST['id_media_mediastorage'];

		$ret_value = array(
			'error' => ''
		);

		$actual_tags = $this->getTagdByIdMediaAndIdLanguageDb($media_id);
		$actual_tags = $this->_toolboxManager->mysqliResultToArray($actual_tags);

		foreach ($actual_tags as $actual_tag) {
			if (!in_array($actual_tag['data'], $_POST["tags"])) {
				$ret = $this->_tagModel->deleteRelationByIdTagMedia($actual_tag['id']);

				if (!empty($ret['error']))
					return $ret;
			}
		}

		if (isset($_POST["tags"])) {
			foreach ($_POST["tags"] as $tag) {
				$ret_value = $this->_tagModel->findTagWithData($tag);

				if (!empty($ret_value['error']))
					return $ret_value;

				$tag_data = $this->_toolboxManager->mysqliResultToData($ret_value);

				if (!empty($tag_data)) {

					$check_presence = $this->_tagModel->findTagdByIdMediaAndIdTag($tag_data['id_tag'], $media_id);

					if (!empty($check_presence['error']))
						return $check_presence;

					if ($check_presence['data']->num_rows == 0) {

						$ret_value = $this->_tagModel->createTagLink($tag_data['id_tag'], $media_id);

						if (!empty($ret_value['error']))
							return $ret_value;
					}
				}
				else {
					$ret_value = $this->createNewTagAndLink($tag, $media_id);

					if (!empty($ret_value['error']))
						return $ret_value;
				}
			}
		}

		return $ret_value;
	}

	public function createNewTagAndLink($tag, $id_media) {
		$ret_value = $this->_tagModel->createNewTag();

		if (!empty($ret_value['error']))
			return $ret_value;

		$id_tag = $ret_value['id'];

		$data_array = array(
			'data_mediastorage' => $tag,
			'id_tag_mediastorage' => $id_tag,
			'id_language_mediastorage' => $_SESSION['id_language_mediastorage'],
		);
		$ret_value = $this->_tagLanguageModel->createNewTagLanguage($data_array);

		if (!empty($ret_value['error']))
			return $ret_value;

		return $this->_tagModel->createTagLink($id_tag, $id_media);
	}

	public function getAllTagsByIdLanguageDb() {
		return $this->_tagLanguageModel->findAllTagsByIdLanguage($_SESSION['id_language_mediastorage']);
	}

	public function formatTagsDataArray($data) {
		$return_array = array();

		foreach ($data as $row) {
			$return_array[] = $row['data'];
		}

		return $return_array;
	}

	public function getTagdByIdMediaAndIdLanguageDb($id_media) {
		return $this->_tagModel->findTagdByIdMediaAndIdLanguage($_SESSION['id_language_mediastorage'], $id_media);
	}
}