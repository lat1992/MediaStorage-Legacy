<?php

require_once('CoreBundle/models/Folder.php');

class FolderManager {

	private $_folderModel;

	public function __construct() {
		$this->_folderModel = new Folder();
	}

	public function getAllFoldersDb() {
		return $this->_folderModel->findAllFolders();
	}

	public function formatFolderArrayWithPostData() {
		$folder = array();

		$parent = null;

		if (isset($_POST['id_parent_mediastorage'])) {
			foreach ($_POST['id_parent_mediastorage'] as $data_parent) {
				if ($data_parent)
					$parent = $data_parent;
			}
		}
		if ($parent == null)
			$parent = 'NULL';

		$translate = array();
		$cpt = 0;
		foreach ($_POST['data_mediastorage'] as $key => $value) {
			if ($value) {
				$translate[$cpt]['id_language'] = $key;
				$translate[$cpt]['data'] = $value;
				$cpt++;
			}
		}

		$_POST['data_mediastorage'] = $translate;

		$_POST['id_parent_mediastorage'] = $parent;
		$_POST['id_organization_mediastorage'] = $_SESSION['id_organization'];

		$folder['id_parent'] = $_POST['id_parent_mediastorage'];
		$folder['id_organization'] = $_POST['id_organization_mediastorage'];
		$folder['data_mediastorage'] = $_POST['data_mediastorage'];

		return $folder;
	}

	public function folderCreateFormCheck() {
		$error_folder = array();

		// if (!$_POST['id_parent_mediastorage']) {
		// 	$error_folder[] = PARENT_FOLDER_EMPTY;
		// }
		if (empty($_POST['data_mediastorage'])) {
			$error_folder[] = INVALID_DATA_EMPTY;
		}

		return $error_folder;
	}

	public function folderEditFormCheck() {
		$error_folder = array();

		if (empty($_POST['data_mediastorage'])) {
			$error_folder[] = INVALID_DATA_EMPTY;
		}

		if ($_POST['id_parent_mediastorage'] &&  ($_POST['id_parent_mediastorage'] == $_GET['folder_id'])) {
			$error_folder[] = INVALID_PARENT_ID;
		}

		return $error_folder;
	}

	public function folderCreateDb() {
		return $this->_folderModel->createNewFolder($_POST);
	}

	public function getFolderByIdDb($folder_id) {
		return $this->_folderModel->findFolderById($folder_id, $_SESSION['id_language_mediastorage']);
	}

	public function folderEditDb($folder_data) {
		return $this->_folderModel->updateFolderWithId($_POST, $folder_data['id']);
	}

	public function folderEditAsAdminDb($folder_data) {
		if (strcmp($_POST['id_parent_mediastorage'], 'NULL') == 0) {
			if (is_null($folder_data['id_parent'])) {
				$_POST['id_parent_mediastorage'] = 'NULL';
			}
			else {
				$_POST['id_parent_mediastorage'] = $folder_data['id_parent'];
			}
		}

		return $this->_folderModel->updateFolderWithIdAsAdmin($_POST, $folder_data['id']);
	}

	public function removeFolderByIdDb($folder_id) {
		return $this->_folderModel->deleteFolderById($folder_id);
	}

	public function getAllFoldersWithoutParentsByOrganizationDb() {
		return $this->_folderModel->findAllFolderWithoutParentsByOrganization($_SESSION['id_organization'], $_SESSION['id_language_mediastorage']);
	}

	public function getFolderByParentIdAndOrganizationIdDb($parent_id) {
		return $this->_folderModel->findAllFolderWithParentIdAndOrganization($parent_id, $_SESSION['id_organization'], $_SESSION['id_language_mediastorage']);
	}

	public function ajaxGetFolderByParentIdDb($parent_id) {
		return $this->_folderModel->findAllFolderWithParentIdAndOrganization($parent_id, $_SESSION['id_organization']);
	}

	public function formatPathData($path) {

		$path = array_reverse($path);
		$final_path = FOLDER . '<span class="to_hide_mobile"> : ';
		$cpt = 0;

		foreach ($path as $path_data) {

			if ($cpt != 0) {
				$final_path .= '/';
			}

			$final_path .= '<a href="?page=folder&parent_id=' . $path_data['id'] . '">' . $path_data['data'] . '</a>';

			$cpt++;
		}

		$final_path .= '</span>';

		return $final_path;
	}

	public function getFolderPathByFolderId($folder_id) {

		$check = 0;
		$path = array();
		$result = $this->getFolderByIdDb($folder_id, $_SESSION['id_language_mediastorage']);
		$cpt = 0;

		if (!empty($result['error']))
			return $result;

		while ($check != 1) {

			if ($result['data']->num_rows == 0) {
				$check = 1;
			}
			else {
				$data = $result['data']->fetch_assoc();

				$path[$cpt]['data'] = $data['translate'];
				$path[$cpt]['id'] = $data['id'];

				if (is_null($data['id_parent'])) {
					$check = 1;
				}
				else {
					$result = $this->getFolderByIdDb($data['id_parent'], $_SESSION['id_language_mediastorage']);

					if (!empty($result['error']))
						return $result;
				}
			}
			$cpt++;
		}

		return $path;
	}
}