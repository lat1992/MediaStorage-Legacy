<?php

require_once('CoreBundle/models/Tag.php');

class TagManager {

	private $_tagModel;

	public function __construct() {
		$this->_tagModel = new Tag();
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
}