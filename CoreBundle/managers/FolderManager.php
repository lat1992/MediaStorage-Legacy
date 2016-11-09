<?php

require_once('CoreBundle/models/Folder.php');
require_once('CoreBundle/managers/MediaManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class FolderManager {

	private $_folderModel;
	private $_toolboxManager;
	private $_mediaManager;

	private $_rowNbPerPages = 10;
	private $_rowNbPerViewPages = 9;

	public function __construct() {
		$this->_folderModel = new Folder();
		$this->_toolboxManager = new ToolboxManager();
	}

	public function getAllFoldersDb() {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;

		return $this->_folderModel->findAllFoldersWithLimit($_SESSION['id_organization'], $offset, $size);
	}

	public function getPageNumberDb() {
		$result = $this->_folderModel->getAllFoldersCount($_SESSION['id_organization']);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerPages;

		return (ceil($pages));
	}

	public function getPageNumberForFolderViewDb($id_parent) {
		$result = $this->_folderModel->getAllFoldersCountByIdParent($_SESSION['id_organization'], $id_parent);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerViewPages;
		$pages = ($pages) ? : 1;

		return (ceil($pages));
	}

	public function setCurrentPage(&$current_page) {
		$current_page = (isset($_GET['paginate'])) ? intval($_GET['paginate']) : 1;
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
				$translate[$cpt]['description'] = $_POST['description_mediastorage'][$key];
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
		return $this->_folderModel->updateFolderWithIdAsAdmin($_POST, $folder_data['id']);
	}

	public function getAllFoldersWithoutParentsByOrganizationDb() {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerViewPages;
		$offset = $page * $size;

		return $this->_folderModel->findAllFolderWithoutParentsByOrganizationWithLimit($_SESSION['id_organization'], $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getFolderByParentIdAndOrganizationIdDb($parent_id) {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerViewPages;
		$offset = $page * $size;

		return $this->_folderModel->findAllFolderWithParentIdAndOrganizationWithLimit($parent_id, $_SESSION['id_organization'], $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function ajaxGetFolderByParentIdDb($parent_id) {
		return $this->_folderModel->findAllFolderWithParentIdAndOrganization($parent_id, $_SESSION['id_organization'], $_SESSION['id_language_mediastorage']);
	}

	public function formatPathData($path) {

		$final_path['title'] = FOLDER . '<span class="to_hide_mobile"> : ' . $path[0]['data'] . '</span>';
		$final_path['breadcrumb'] = '';
		$cpt = 0;

		$path = array_reverse($path);

		foreach ($path as $path_data) {

			if ($cpt != 0) {
				$final_path['breadcrumb'] .= ' / ';
			}

			$final_path['breadcrumb'] .= '<a href="?page=folder&parent_id=' . $path_data['id'] . '">' . $path_data['data'] . '</a>';

			$cpt++;
		}

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

	public function removeFolderByIdDb($folder_id) {
		$_mediaManager = new MediaManager();
		$_folderLanguageManager = new FolderLanguageManager();

		$_mediaManager->modifyFolderIdWithNullByIdDb($folder_id);
		$this->_folderModel->updateParentFolderWithNullById($folder_id);
		$_folderLanguageManager->removeFolderLanguageByFolderIdDb($folder_id);
		return $this->_folderModel->deleteFolderById($folder_id);
	}

	public function getParentFolderDataByMediaDb($media) {
		$exit = 0;
		$cpt = 0;
		$data = array();
		$return_data = array();

		// Return empty array in case of link to any folder
		if (is_null($media))
			return $return_data;

		$result = $media;

		while ($exit != 1) {
			// Make sure that the folder exist
			if (isset($result['data']) && $result['data']->num_rows == 0) {
				$exit = 1;
			}
			else {

				$data = $this->gatherAndFillDataForParentFolderView($result, $return_data, $cpt);

				// Check if the current folder is the highest folder
				if (is_null($data['id_parent']))
					$exit = 1;
				else {
					// Get next folder (the next one is the parent)
					$result = $this->getFolderByIdDb($data['id_parent'], $_SESSION['id_language_mediastorage']);
				}
			}
			$cpt++;
		}

		$this->formatDataForParentFolderView($return_data);

		return $return_data;
	}

	public function getParentFolderDataByFolderIdDb($folder_id) {
		$exit = 0;
		$cpt = 0;
		$data = array();
		$return_data = array();

		// Return empty array in case of link to any folder
		if (is_null($folder_id))
			return $return_data;

		// Get the first current folder
		$result = $this->getFolderByIdDb($folder_id, $_SESSION['id_language_mediastorage']);

		while ($exit != 1) {
			// Make sure that the folder exist
			if ($result['data']->num_rows == 0) {
				$exit = 1;
			}
			else {

				$data = $this->gatherAndFillDataForParentFolderView($result, $return_data, $cpt);

				// Check if the current folder is the highest folder
				if (is_null($data['id_parent']))
					$exit = 1;
				else {
					// Get next folder (the next one is the parent)
					$result = $this->getFolderByIdDb($data['id_parent'], $_SESSION['id_language_mediastorage']);
				}
			}
			$cpt++;
		}

		$this->formatDataForParentFolderView($return_data);

		return $return_data;
	}

	public function gatherAndFillDataForParentFolderView(&$result, &$return_data, &$cpt) {
		// data is now containing the current folder data
		if (isset($result['data']))
			$data = $this->_toolboxManager->mysqliResultToData($result);
		else {
			$data = $result;
			$data['id_parent'] = $data['id_folder'];
		}

		// Checking if the current folder is the higher one (without parents or not)
		if (!is_null($data['id_parent'])) {
			// Get all folders with the parent id equal to the current folder, so we have all the folders with the same parents id
			$folders = $this->getFolderByParentIdAndOrganizationIdDb($data['id_parent']);
		}
		else {
			// Get all folders without parents, means we gather the higher lever of folders
			$folders = $this->getAllFoldersWithoutParentsByOrganizationDb();
		}

		$return_data[$cpt]['data'] = $data;
		$return_data[$cpt]['id'] = $data['id_parent'];
		$return_data[$cpt]['folders'] = $this->_toolboxManager->mysqliResultToArray($folders);

		// Returning the data in order to make some checl on the current folder
		return $data;
	}

	public function formatDataForParentFolderView(&$return_data) {
		// Unset the first element because it contains the folder itself
		if (count($return_data) > 0) {
			foreach ($return_data[0]['folders'] as $key => $value) {
				if (strcmp($return_data[0]['data']['id'], $value['id']) == 0) {
					unset($return_data[0]['folders'][$key]);
					if (empty($return_data[0]['folders'])) {
						unset($return_data[0]);
					}
				}
			}
		}

		if (empty($return_data[0]['folders']))
			unset($return_data[0]);

		// Reverse in order to have the closest folder of the folder at the end for the view, look at the view of file creation/edit to understand
		$return_data = array_reverse($return_data);
	}
}