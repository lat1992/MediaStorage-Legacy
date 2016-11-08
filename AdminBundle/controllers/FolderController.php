<?php

require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/FolderLanguageManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/LanguageManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('AdminBundle/ressources/fine-uploader-server/handler.php');

class FolderController {

	private $_folderManager;
	private $_folderLanguageManager;
	private $_organizationManager;
	private $_languageManager;
	private $_toolboxManager;
	private $_designManager;
	private $_uploadHandler;

	private $_errorArray;

	public function __construct() {
		$this->_folderManager = new FolderManager();
		$this->_folderLanguageManager = new FolderLanguageManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_languageManager = new LanguageManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();
		$this->_uploadHandler = new UploadHandler();

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
		$folders = $this->_folderManager->getAllFoldersDb();
		$total_pages = $this->_folderManager->getPageNumberDb();
		$this->_folderManager->setCurrentPage($current_page);

		$this->mergeErrorArray($folders);

		$table_header = array(
				'<th>' . NAME . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($folder = $folders['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $folder['translate'] . '</td>',
					'<td class="td-link" ><a href="?page=edit_folder_admin&folder_id=' . $folder['id'] . '" class="td-link-button button-edit">' . EDIT . '</a></td>',
					'<td class="td-link" ><a href="?page=delete_folder_admin&folder_id=' . $folder['id'] . '" class="td-link-button button-delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = FOLDER_LIST_TITLE;

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('AdminBundle/views/folder/folder_list.php');
	}

	public function createAction() {
		$folder = array();

		if (isset($_POST['id_folder_create_mediastorage']) && (strcmp($_POST['id_folder_create_mediastorage'], '984156') == 0)) {

			$folder = $this->_folderManager->formatFolderArrayWithPostData();
			$return_value['error'] = $this->_folderManager->folderCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_folderManager->folderCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$_POST['id_folder_mediastorage'] = $return_value['id'];
					$return_value = $this->_folderLanguageManager->folderLanguageCreateAsAdminDb();
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=create_folder_admin');
						exit;
					}
				}
			}
		}

		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();

		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);

		$languages = $this->_toolboxManager->mysqliResultToArray($languages);

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('AdminBundle/views/folder/folder_create.php');
	}

	public function editAction() {
		$folder_data = $this->_folderManager->getFolderByIdDb($_GET['folder_id']);
		$folders = $this->_folderManager->getAllFoldersWithoutParentsByOrganizationDb();
		$languages = $this->_languageManager->getAllLanguagesByGroupDb();
		$folder_language_data = $this->_folderLanguageManager->getFolderLanguageByFolderIdDb($_GET['folder_id']);
		$parent_folder_data = $this->_folderManager->getParentFolderDataByFolderIdDb($_GET['folder_id']);

		$this->mergeErrorArray($folder_data);
		$this->mergeErrorArray($folders);
		$this->mergeErrorArray($languages);
		$this->mergeErrorArray($folder_language_data);

		$languages = $this->_toolboxManager->mysqliResultToArray($languages);

		if (count($this->_errorArray) == 0) {

			while ($folder_data_temp = $folder_data['data']->fetch_assoc()) {
				$folder = $folder_data_temp;
			}

			while ($folder_language_data_temp = $folder_language_data['data']->fetch_assoc()) {
				$folder_language[$folder_language_data_temp['id_language']] = $folder_language_data_temp;
			}

			if (isset($_POST['id_folder_create_mediastorage']) && (strcmp($_POST['id_folder_create_mediastorage'], '984156') == 0)) {

				$this->_folderManager->formatFolderArrayWithPostData();
				$return_value['error'] = $this->_folderManager->folderEditFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_folderManager->folderEditAsAdminDb($folder);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {

						$_POST['id_folder_mediastorage'] = $_GET['folder_id'];
						$return_value = $this->_folderLanguageManager->folderLanguageEditAsAdminDb();
						$this->mergeErrorArray($return_value);

						if (count($this->_errorArray) == 0) {
							$_SESSION['flash_message'] = ACTION_SUCCESS;
							header('Location:' . '?page=list_folder_admin');
							exit;
						}
					}
				}

			}
			elseif (isset($_GET['delete_image'])) {
				unlink("uploads/thumbnails/files/" . $_SESSION['id_organization'] . "/folders/thumbnail_folder_" . $_GET['folder_id'] . ".png");
				header('location: ' . '?page=edit_folder_admin&folder_id=' . $_GET['folder_id']);
				exit;
			}

		}

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		include ('AdminBundle/views/folder/folder_create.php');
	}

	// public function deleteAction() {
	// 	if (isset($_GET['folder_id'])) {

	// 		$return_value = $this->_folderManager->removeFolderByIdDb($_GET['folder_id']);
	// 		$this->mergeErrorArray($return_value);

	// 		if (count($this->_errorArray) == 0) {
	// 			header('Location:' . '?page=dashboard');
	// 		}
	// 	}

	// 	include ('CoreBundle/views/common/error.php');
	// }

	public function ajaxGetFolderByParentIdAction() {
		if (!isset($_GET['folder_id']) || !$_GET['folder_id']) {
			echo '';
			return;
		}

		$folder_data = $this->_folderManager->ajaxGetFolderByParentIdDb($_GET['folder_id']);
		$this->mergeErrorArray($folder_data);

		if (count($this->_errorArray) == 0) {

			$folder = array();

			while ($folder_data_temp = $folder_data['data']->fetch_assoc()) {
				$folder[] = $folder_data_temp;
			}

			if ($folder)
				echo json_encode($folder);
		}

		echo '';
		return;
	}

	public function uploadThumbnailAction() {
        $mainPath = 'uploads/thumbnails/files/' . $_SESSION['id_organization'] . '/folders/tmp/';
        $basePath = 'uploads/thumbnails/files/' . $_SESSION['id_organization'] . '/folders/';
        $chunkpath = 'uploads/thumbnails/chunks/' . $_SESSION['id_organization'] . '/folders/';

        // CLEAN TMP FOLDER
		$files = glob($mainPath . '*');
		foreach($files as $file) {
			unlink($file);
		}

		if (!file_exists('uploads/thumbnails/files/' . $_SESSION['id_organization'] . '/folders/tmp/')) {
		    mkdir('uploads/thumbnails/files/' . $_SESSION['id_organization'] . '/folders/tmp/', 0777, true);
		}
		if (!file_exists('uploads/thumbnails/chunks/' . $_SESSION['id_organization'] . '/folders/')) {
		    mkdir('uploads/thumbnails/chunks/' . $_SESSION['id_organization'] . '/folders/', 0777, true);
		}

        $this->_uploadHandler->allowedExtensions = array('jpeg', 'png', 'jpg');
        $this->_uploadHandler->inputName = "qqfile";

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "POST") {

            header("Content-Type: text/plain");

            if (isset($_GET["done"])) {
                $result = $this->_uploadHandler->combineChunks($mainPath);
                $file_name = $this->_uploadHandler->getUploadName();
            }

            else {
                $result = $this->_uploadHandler->handleUpload($mainPath);
                $file_name = $this->_uploadHandler->getUploadName();
            }

            if ($file_name && $result['uuid']) {
            	$filename_explode_array = explode('.', $file_name);
            	$filename_explode_array = array_reverse($filename_explode_array);

                $old_path = $mainPath . $result['uuid'] . '/' . $file_name;
               	$new_path = $mainPath . 'thumbnail_folder_' . $_GET['folder_id'] . '.' . $filename_explode_array[0];
               	$result['oldname'] = $old_path;

                rename($old_path, $new_path);
            	$image = imagecreatefromstring(file_get_contents($new_path));
            	imagepng($image, $basePath . 'thumbnail_folder_' . $_GET['folder_id'] . '.png');
            	imagedestroy($image);
                rmdir($mainPath . $result['uuid']);

                $result['img_path'] = $basePath . 'thumbnail_folder_' . $_GET['folder_id'] . '.png';
            }

            echo json_encode($result);
        }

        else if ($method == "DELETE") {
            $result = $this->_uploadHandler->handleDelete("files");
            echo json_encode($result);
        }

        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }

	}

	public function deleteAction() {
		$_SESSION['flash_message'] = 'Action non fonctionnelle pour le moment';
		header('Location:' . '?page=list_folder_admin');
		exit;

	}
}