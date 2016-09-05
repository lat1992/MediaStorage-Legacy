<?php

require_once('CoreBundle/managers/SharelistManager.php');
require_once('CoreBundle/managers/SharelistMediaManager.php');

class SharelistPageController {

	private $_sharelistManager;
	private $_sharelistMediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_sharelistManager = new SharelistManager();
		$this->_sharelistMediaManager = new SharelistMediaManager();

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

	public function sharelistPageAction() {

		$sharelist_data = $this->_sharelistManager->getAllSharelistsByUserIdDb();

		$this->mergeErrorArray($sharelist_data);

		$title = SHARELIST;

		include ('ClientBundle/views/sharelist/sharelist.php');
	}

	public function createSharelistAction() {

		if (isset($_POST['id_sharelist_create_mediastorage']) && (strcmp($_POST['id_sharelist_create_mediastorage'], '895143') == 0)) {

			$sharelist_id = 0;

			$return_value['error'] = $this->_sharelistManager->sharelistCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$_POST['id_user_mediastorage'] = $_SESSION['user_id_mediastorage'];

				$return_value = $this->_sharelistManager->sharelistCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$sharelist_id = $return_value['id'];
					$return_value = $this->_sharelistMediaManager->sharelistMediaMultipleCreateDb($sharelist_id);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=sharelist_edit&sharelist_id=' . $sharelist_id);
						exit;
					}
				}

			}
		}

		$sharelist_medias_data = $this->_sharelistMediaManager->getAllSharelistMediasByUserIdDb();

		$this->mergeErrorArray($sharelist_medias_data);

		$table_header = array(
				'<th></th>',
				'<th>' . FILENAME . '</th>',
				'<th>' . TITLE . '</th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($sharelist_media = $sharelist_medias_data['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td><input type="checkbox" name="sharelist_media_mediastorage[' . $sharelist_media['id'] . '] value="1" /></td>',
					'<td>' . $sharelist_media['filename'] . '</td>',
					'<td><a href="?page=sharelist_edit&sharelist_id=' . $sharelist_media['id'] . '">' . $sharelist_media['translate'] . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_sharelist_media&sharelist_media_id=' . $sharelist_media['id']  . '&sharelist_id=' . $sharelist_media['id_sharelist'] . '" class="button_a delete">' .  DELETE . '</a></td>'
				);
			}

		}

		$title = FOLDER_LIST_TITLE;

		include ('ClientBundle/views/sharelist/sharelist_create.php');
	}

	public function editSharelistAction() {

		$sharelist_media_data = $this->_sharelistMediaManager->getAllSharelistMediasByUserIdAndSharelistIdDb($_GET['sharelist_id']);

		$this->mergeErrorArray($sharelist_media_data);

		$sharelist_data = $this->_sharelistManager->getSharelistByIdDb($_GET['sharelist_id']);

		$this->mergeErrorArray($sharelist_data);

		$sharelist_data = $sharelist_data['data']->fetch_assoc();

		$title = SHARELIST . ' : ' . $sharelist_data['reference'];

		include ('ClientBundle/views/sharelist/sharelist_edit.php');
	}

	public function deleteSharelistAction() {

		$sharelist_data = $this->_sharelistManager->removeSharelistByIdDb($_GET['sharelist_id']);

		$this->mergeErrorArray($sharelist_data);

		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . '?page=sharelist');
			exit;
		}

		include ('ClientBundle/views/sharelist/sharelist.php');
	}

	public function deleteSharelistMediaAction() {

		$sharelist_data = $this->_sharelistMediaManager->removeSharelistMediaByIdDb($_GET['sharelist_media_id']);

		$this->mergeErrorArray($sharelist_data);

		if (count($this->_errorArray) == 0) {

			if (isset($_GET['sharelist_id']) && $_GET['sharelist_id']) {
				$_SESSION['flash_message'] = ACTION_SUCCESS;
				header('Location:' . '?page=sharelist_edit&sharelist_id=' . $_GET['sharelist_id']);
				exit;
			}
			else {
				$_SESSION['flash_message'] = ACTION_SUCCESS;
				header('Location:' . '?page=create_sharelist');
				exit;
			}
		}

		include ('ClientBundle/views/sharelist/sharelist.php');
	}

	public function createSharelistMediaAction() {
		$_POST['id_user_mediastorage'] = $_SESSION['user_id_mediastorage'];
		$_POST['id_media_mediastorage'] = $_GET['media_id'];
		$_POST['id_sharelist_mediastorage'] = 'NULL';

		$cart_data = $this->_sharelistMediaManager->sharelistMediaCreateDb();

		$this->mergeErrorArray($cart_data);

		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . '?page=content&media_id=' . $_GET['original_id']);
			exit;
		}

		include ('CoreBundle/views/common/error.php');
	}
}