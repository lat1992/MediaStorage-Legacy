<?php

require_once('CoreBundle/managers/TagManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class TagController {

	private $_tagManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_tagManager = new TagManager();
		$this->_mediaManager = new MediaManager();

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

	public function listAction() {
		$tags = $this->_tagManager->getAllTagsWithTagLanguageAndLanguageDb();

		$this->mergeErrorArray($tags);

		include ('CoreBundle/views/tag/tag_list.php');
	}

	public function createAction() {
		$tag = array();

		if (isset($_POST['id_tag_create_mediastorage']) && (strcmp($_POST['id_tag_create_mediastorage'], '984156') == 0)) {
			$tag = $this->_tagManager->formatTagArrayWithPostData();
			$return_value['error'] = $this->_tagManager->tagCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_tagManager->tagCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$medias = $this->_mediaManager->getAllMediasDb();
		$this->mergeErrorArray($medias);

		include ('CoreBundle/views/tag/tag_create.php');
	}

	public function editAction() {
		$tag_data = $this->_tagManager->getTagByIdDb($_GET['tag_id']);
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($tag_data);
		$this->mergeErrorArray($medias);

		if (count($this->_errorArray) == 0) {

			while ($tag_data_temp = $tag_data['data']->fetch_assoc()) {
				$tag = $tag_data_temp;
			}

			if (isset($_POST['id_tag_create_mediastorage']) && (strcmp($_POST['id_tag_create_mediastorage'], '984156') == 0)) {
				$return_value['error'] = $this->_tagManager->tagCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_tagManager->tagEditDb($tag);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/tag/tag_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['tag_id'])) {

			$return_value = $this->_tagManager->removeTagByIdDb($_GET['tag_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}