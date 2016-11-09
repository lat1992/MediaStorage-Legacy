<?php

require_once('CoreBundle/models/Media.php');
require_once('CoreBundle/managers/FolderManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaExtraManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');

class MediaManager {

	private $_mediaModel;

	private $_folderManager;
	private $_toolboxManager;
	private $_mediaExtraFieldManager;
	private $_mediaExtraManager;

	private $_rowNbPerPages = 9;
	private $_rowNbPerViewPages = 9;

	public function __construct() {
		$this->_mediaModel = new Media();

		$this->_folderManager = new FolderManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager();
		$this->_mediaExtraManager = new MediaExtraManager();
	}

	public function getAllMediasDb() {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllmediasByIdOrganizationAndIdType($_SESSION['id_organization'], 1, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getPageNumberDb($id_type) {
		$result = $this->_mediaModel->getAllMediasCount($_SESSION['id_organization'], $id_type, $_SESSION['id_language_mediastorage']);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerPages;

		return (ceil($pages));
	}

	public function getPageNumberForMediaViewDb($id_parent, $id_type) {
		$result = $this->_mediaModel->getAllMediasCountByIdParent($_SESSION['id_organization'], $id_type, $_SESSION['id_language_mediastorage'], $id_parent);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerViewPages;

		return (ceil($pages));
	}

	public function getPageNumberForFolderViewDb($id_folder, $id_type) {
		$result = $this->_mediaModel->getAllMediasCountByIdFolder($_SESSION['id_organization'], $id_type, $id_folder);
		$data = $this->_toolboxManager->mysqliResultToData($result);
		$pages = intval($data['count']) / $this->_rowNbPerViewPages;
		return (ceil($pages));
	}

	public function setCurrentPage(&$current_page) {
		$current_page = (isset($_GET['paginate'])) ? intval($_GET['paginate']) : 1;
	}


	public function getAllProgramsByIdOrganizationDb() {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllmediasByIdOrganizationAndIdType($_SESSION['id_organization'], 1, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getAllContentsByIdOrganizationDb() {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdType($_SESSION['id_organization'], 2, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getAllProgramsByIdOrganizationAndFolderIdDb($id_folder) {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerViewPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdTypeAndFolderId($_SESSION['id_organization'], 1, $id_folder, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getAllContentsByIdOrganizationAndFolderIdDb($id_folder) {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerViewPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdTypeAndFolderId($_SESSION['id_organization'], 2, $id_folder, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getAllContentsByIdOrganizationAndParentIdDb($id_parent) {
		// This is in order to paginate the results
		$page = 0;

		if (isset($_GET['paginate'])) {
			$page = intval($_GET['paginate']) - 1;
			if ($page < 0)
				$page = 0;
		}

		$size = $this->_rowNbPerPages;
		$offset = $page * $size;

		return $this->_mediaModel->findAllMediasByIdOrganizationAndIdTypeAndParentId($_SESSION['id_organization'], 2, $id_parent, $_SESSION['id_language_mediastorage'], $offset, $size);
	}

	public function getAllProgramsWithoutParentsByOrganizationDb() {
		return $this->_mediaModel->findAllMediasWithoutParentsByIdOrganizationAndIdType($_SESSION['id_organization'], 1, $_SESSION['id_language_mediastorage']);
	}

	public function getAllContentsWithoutParentsByOrganizationDb() {
		return $this->_mediaModel->findAllMediasWithoutParentsByIdOrganizationAndIdType($_SESSION['id_organization'], 2, $_SESSION['id_language_mediastorage']);
	}

	public function formatMediaArrayWithPostData() {
		$media = array();

		$media['id_type'] = $_POST['id_type_mediastorage'];
		$media['reference'] = $_POST['reference_mediastorage'];
		$media['reference_client'] = $_POST['reference_client_mediastorage'];
		$media['right_view'] = $_POST['right_view_mediastorage'];

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
		$created_date = date('Y-m-d H:i:s');
		$modified_date = date('Y-m-d H:i:s');

		$_POST['created_date_mediastorage'] = $created_date;
		$_POST['modified_date_mediastorage'] = $modified_date;

		return $this->_mediaModel->createNewMedia($_POST);
	}

	public function getMediaByIdDb($media_id) {
		return $this->_mediaModel->findMediaByid($media_id, $_SESSION['id_language_mediastorage']);
	}

	public function getMediaByIdAndOrganizationIdDb($id_media) {
		return $this->_mediaModel->findMediaByidAndOrganizationId($id_media, $_SESSION['id_organization']);
	}

	public function mediaEditDb($media_data) {
		return $this->_mediaModel->updateMediaWithId($_POST, $media_data['id']);
	}

	public function checkAndMediaEditDb($media_data) {
		if (strcmp($_POST['id_parent_mediastorage'], 'NULL') == 0) {
			if (is_null($media_data['id_parent'])) {
				$_POST['id_parent_mediastorage'] = 'NULL';
			}
			else {
				$_POST['id_parent_mediastorage'] = $media_data['id_parent'];
			}
		}

		$modified_date = date('Y-m-d H:i:s');

		$_POST['modified_date_mediastorage'] = $modified_date;

		if (isset($media_data['reference']) && $media_data['reference'])
			$_POST['reference_mediastorage'] = $media_data['reference'];

		return $this->_mediaModel->updateMediaWithId($_POST, $media_data['id']);
	}

	public function removeMediaByIdDb($media_id) {
		$_mediaFileManager = new MediaFileManager();
		$_mediaInfoManager = new MediaInfoManager();
		$_tagManager = new TagManager();

		$this->_mediaExtraManager->removeMediaExtraByMediaIdDb($media_id);
		$_mediaFileManager->removeMediaFileByMediaIdDb($media_id);
		$_mediaInfoManager->removeMediaInfoByMediaIdDb($media_id);
		$_tagManager->removeTagByMediaDb($media_id);
		return $this->_mediaModel->deleteMediaById($media_id);
	}

	public function ajaxGetMediaByParentIdDb($parent_id) {
		return $this->_mediaModel->findAllMediaWithParentIdAndOrganization($parent_id, $_SESSION['id_organization']);
	}

	public function preFillMediaPostData($id_type) {

		$folder = null;

		foreach ($_POST['id_folder_mediastorage'] as $data_folder) {
			if ($data_folder)
				$folder = $data_folder;
		}
		if ($folder == null)
			$folder = 'NULL';

		$parent = null;

		if (isset($_POST['id_parent_mediastorage'])) {
			foreach ($_POST['id_parent_mediastorage'] as $data_parent) {
				if ($data_parent)
					$parent = $data_parent;
			}
		}
		if ($parent == null)
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
		if (strlen($_POST['reference_client_mediastorage']) > 100) {
			$error_media[] = INVALID_MEDIA_REFERENCE_TOO_LONG;
		}

		foreach ($_POST['title_mediastorage'] as $key => $value) {

			if ( strlen($_POST['title_mediastorage'][$key]) == 0 &&
				strlen($_POST['subtitle_mediastorage'][$key]) == 0 &&
				strlen($_POST['description_mediastorage'][$key])) {
				unset($_POST['title_mediastorage'][$key]);
				unset($_POST['subtitle_mediastorage'][$key]);
				unset($_POST['description_mediastorage'][$key]);
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


	public function formatPathData($path) {
		if (isset($path[0])) {

			if (intval($path[0]['type']) == 1)
				$final_path['title'] = PROGRAM . '<span class="to_hide_mobile"> : ' . $path[0]['data'] . '</span>';
				elseif (intval($path[0]['type']) == 2)
				$final_path['title'] = CONTENT . '<span class="to_hide_mobile"> : ' . $path[0]['data'] . '</span>';
			else
				$final_path['title'] = FOLDER . '<span class="to_hide_mobile"> : ' . $path[0]['data'] . '</span>';

		}

		$path = array_reverse($path);
		$cpt = 0;
		$final_path['breadcrumb'] = '';

		foreach ($path as $path_data) {

			if ($cpt != 0) {
				$final_path['breadcrumb'] .= ' / ';
			}

			if (intval($path_data['type']) == 1)
				$final_path['breadcrumb'] .= '<a href="?page=program&media_id=' . $path_data['id'] . '">' . $path_data['data'] . '</a>';
			elseif (intval($path_data['type']) == 2)
				$final_path['breadcrumb'] .= '<a href="?page=content&media_id=' . $path_data['id'] . '">' . $path_data['data'] . '</a>';
			else
				$final_path['breadcrumb'] .= '<a href="?page=folder&parent_id=' . $path_data['id'] . '">' . $path_data['data'] . '</a>';

			$cpt++;
		}

		return $final_path;
	}

	public function getMediaByMediaId($media_id) {
		$check = 0;
		$path = array();
		$result = $this->getMediaByIdDb($media_id);
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
				$path[$cpt]['type'] = $data['id_type'];

				if (is_null($data['id_parent'])) {
					$check = 1;
				}
				else {
					$result = $this->getMediaByIdDb($data['id_parent']);

					if (!empty($result['error']))
						return $result;
				}
			}
			$cpt++;
		}

		$check = 0;

		if (isset($data) && !is_null($data['id_folder'])) {

			$result = $this->_folderManager->getFolderByIdDb($data['id_folder']);

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
					$path[$cpt]['type'] = 0;

					if (is_null($data['id_parent'])) {
						$check = 1;
					}
					else {
						$result = $this->_folderManager->getFolderByIdDb($data['id_parent']);

						if (!empty($result['error']))
							return $result;
					}
				}
				$cpt++;
			}
		}

		return $path;
	}

	public function formatProgramPageContentForCard($content_raw) {
		$content_data = $this->_toolboxManager->mysqliResultToArray($content_raw);
		$return_array = array();
		$cpt_array = 0;
		$cpt_return_array = 0;

		foreach ($content_data as $content) {
			$media_extra_data = $this->_mediaExtraFieldManager->getAllMediaExtraFieldByOrganizationAndType(2);
			if (!empty($media_extra_data['error']))
				return $media_extra_data;
			$media_extra = $this->_mediaExtraFieldManager->prepareDataForView($media_extra_data);

			$media_extras_user_data = $this->_mediaExtraManager->getMediaExtraByMediaIdDb($content['id']);
			if (!empty($media_extras_user_data['error']))
				return $media_extras_user_data;
			$media_user_extras = $this->_toolboxManager->mysqliResultToArray($media_extras_user_data);
			$media_user_extras = $this->_mediaExtraManager->formatMediaExtraDataForView($media_user_extras);

			$return_array[$cpt_return_array] = $content;
			$return_array[$cpt_return_array]['extra'] = array();

            foreach ($media_extra as $id_info_field => $value) {

            	if (!intval($value['data'][0]['display_in_card']))
            		continue;

                if (strcmp($value['type'], 'Text') == 0) {
                    $user_value = "";
                    if (isset($media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data']))
                        $user_value = $media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data'];
                }
				elseif (strcmp($value['type'], 'Date') == 0) {
					$user_value = "";
					if (isset($media_user_extras[$id_info_field]['data']))
						$user_value = $media_user_extras[$id_info_field]['data'];
				}
				elseif (strcmp($value['type'], 'Array_multiple') == 0) {
					foreach ($value['data'] as $row) {
						$user_value = "";
						$cpt = 0;
						if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false) {
							if ($cpt > 0)
								$user_value .= ', ' . $row['element'];
							else
								$user_value .= $row['element'];
							$cpt++;
						}
					}
				}
				elseif (strcmp($value['type'], 'Array_unique') == 0) {
					foreach ($value['data'] as $row) {
						$user_value = "";

						if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array'])) {
							$user_value = $row['element'];
						}
					}
				}
				elseif (strcmp($value['type'], 'Boolean') == 0) {
					$user_value = NO;
					if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
						$user_value = YES;
				}

                $return_array[$cpt_return_array]['extra'][$cpt_array]['key'] = $value['data'][0]['data'];
				$return_array[$cpt_return_array]['extra'][$cpt_array]['value'] = $user_value;

				$cpt_array++;
			}
			$cpt_return_array++;
		}
		return $return_array;
	}

	public function modifyFolderIdWithNullByIdDb($folder_id) {
		return $this->_mediaModel->updateFolderWithNullById($folder_id);
	}
}