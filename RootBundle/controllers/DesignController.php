<?php

require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
// require_once('CoreBundle/managers/PermitManager.php');
// require_once('CoreBundle/managers/LanguageManager.php');
// require_once('CoreBundle/managers/RolePermitManager.php');
// require_once('CoreBundle/managers/RoleLanguageManager.php');

class DesignController {

	private $_designManager;
	private $_organizationManager;
	private $_toolboxManager;
	// private $_permitManager;
	// private $_languageManager;
	// private $_rolePermitManager;
	// private $_roleLanguageManager;

	private $_errorArray;

	public function __construct() {
		$this->_designManager = new DesignManager();
		$this->_organizationManager = new OrganizationManager();
		$this->_toolboxManager = new ToolboxManager();
		// $this->_permitManager = new PermitManager();
		// $this->_languageManager = new LanguageManager();
		// $this->_rolePermitManager = new RolePermitManager();
		// $this->_roleLanguageManager = new RoleLanguageManager();

		$this->_errorArray = array();
	}

	public function selectOrganizationAction() {
		$design = array();

		if (isset($_POST['id_select_mediastorage']) && (strcmp($_POST['id_select_mediastorage'], '4894565') == 0)) {

			header('Location:' . '?page=edit_design_root&id_organization=' . $_POST['id_organization_mediastorage']);
			exit;
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = DESIGN;

		include ('RootBundle/views/common/select_organization.php');
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

	public function editAction() {
		// $design_data = $this->_designManager->getRoleByIdDb($_GET['design_id']);
		// $organizations = $this->_organizationManager->getAllOrganizationsDb();
		// $id_organization = $design_data['id_organization'];
		// $permits = $this->_permitManager->getAllPermitsDb();
		// $languages = $this->_languageManager->getAllLanguagesDb();

		// $this->mergeErrorArray($design_data);
		// $this->mergeErrorArray($organizations);
		// $this->mergeErrorArray($permits);
		// $this->mergeErrorArray($languages);

		// if (count($this->_errorArray) == 0) {

		// 	while ($design_data_temp = $design_data['data']->fetch_assoc()) {
		// 		$design = $design_data_temp;
		// 	}

		// 	if (isset($_POST['id_design_create_mediastorage']) && (strcmp($_POST['id_design_create_mediastorage'], '984156') == 0)) {
		// 		$return_value['error'] = $this->_designManager->designCreateFormCheck();
		// 		$this->mergeErrorArray($return_value);

		// 		if (count($this->_errorArray) == 0) {
		// 			$return_value = $this->_designManager->designEditDb($design);
		// 			$this->mergeErrorArray($return_value);

		// 			if (count($this->_errorArray) == 0) {

		// 				$_POST['id_design_mediastorage'] = $_GET['design_id'];
		// 				$return_value = $this->_designPermitManager->designPermitMultipleUpdateByRoleIdDb($_GET['design_id']);
		// 				$this->mergeErrorArray($return_value);

		// 				if (count($this->_errorArray) == 0) {

		// 					$return_value = $this->_designLanguageManager->designLanguageEditDb($design);
		// 					$this->mergeErrorArray($return_value);

		// 					if (count($this->_errorArray) == 0) {
		// 						$_SESSION['flash_message'] = ACTION_SUCCESS;
		// 						header('Location:' . '?page=list_design_root&id_organization=' . $id_organization);
		// 						exit;
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}

		// }

		// $selected_group_permit_data = $this->_designPermitManager->getRolePermitByRoleIdDb($_GET['design_id']);

		// $this->mergeErrorArray($selected_group_permit_data);

		// $selected_group_permit = array();

		// if (count($this->_errorArray) == 0) {
		// 	while ($selected_group_permit_temp = $selected_group_permit_data['data']->fetch_assoc()) {
		// 		$selected_group_permit[] = $selected_group_permit_temp['id_permit'];
		// 	}
		// }

		// $title = ROLE_EDIT_TITLE;

		// include ('RootBundle/views/design/design_create.php');

		$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_GET['id_organization']);
		$this->mergeErrorArray($designs_data);

		if (isset($_POST['design_create_mediastorage']) && (strcmp($_POST['design_create_mediastorage'], '87463975') == 0)) {

			$return_value = $this->_designManager->createOrEditDesignsDb();

			if (count($this->_errorArray) == 0) {
				$_SESSION['flash_message'] = ACTION_SUCCESS;
				header('Location:' . '?page=edit_design_root&id_organization=' . $_GET['id_organization']);
				exit;
			}
		}

		if (count($this->_errorArray) == 0) {
			$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);

			$designs = $this->_designManager->formatDataForView($designs);

		}

		$title = DESIGN;

		include ('RootBundle/views/design/design_create.php');
	}
}