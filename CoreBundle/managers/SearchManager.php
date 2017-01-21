<?php

require_once('CoreBundle/models/Search.php');
require_once('CoreBundle/managers/MediaExtraFieldManager.php');
require_once('CoreBundle/managers/MediaExtraArrayManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');

class SearchManager {

	private $_searchModel;
	private $_mediaExtraFieldManager;
	private $_mediaExtraArrayManager;
	private $_toolboxManager;

	public function __construct() {
		$this->_searchModel = new Search();
		$this->_mediaExtraFieldManager = new MediaExtraFieldManager;
		$this->_mediaExtraArrayManager = new MediaExtraArrayManager;
		$this->_toolboxManager = new ToolboxManager;
	}

	public function liveSearch($keyword, $id_organization, $id_language) {
		return $this->_searchModel->getLiveSearch($keyword, $id_organization, $id_language);
	}

	public function quickSearch($keyword, $id_organization, $id_language) {
		return $this->_searchModel->getLiveSearch($keyword, $id_organization, $id_language);
		//return $this->_searchModel->searchAll($keyword, $id_organization, $id_language);
	}

	public function searchFolder($keyword, $id_organization, $id_language, $paginate, $gap) {
		return $this->_searchModel->searchFolder($keyword, $id_organization, $id_language, $paginate, $gap);
	}

	public function searchMediaProgram($keyword, $id_organization, $id_language, $paginate, $gap) {
		return $this->_searchModel->searchMedia($keyword, 1, $id_organization, $id_language, $paginate, $gap);
	}

	public function searchMediaContent($keyword, $id_organization, $id_language, $paginate, $gap) {
		return $this->_searchModel->searchMedia($keyword, 2, $id_organization, $id_language, $paginate, $gap);
	}

	public function getFormInputsData() {
		$media_extra_field = $this->_mediaExtraFieldManager->getAllMediaExtraFieldsWithOrganizationDb($_SESSION['id_organization']);
		$media_extra_field = $this->_toolboxManager->mysqliResultToArray($media_extra_field);

		$media_extra_array = $this->_mediaExtraArrayManager->getMediaExtraArrayByIdOrganizationAndIdLanguage($_SESSION['id_organization']);
		$media_extra_array = $this->_toolboxManager->mysqliResultToArray($media_extra_array);

		//
		// Regroup media extra array data into media extra field
		//

		$formated_media_extra_array = array();

		// Format media extra array data into a new array

		foreach ($media_extra_array as $key => $value) {
			$index = intval($value['id_field']);

			$formated_media_extra_array[$index][$value['id']] = $value['element'];
		}

		// Use formated media extra array data into the media extra field array

		foreach ($media_extra_field as $key => $value) {
			$index = intval($value['id']);
			$media_extra_field[$key]['data'] = array();

			if (isset($formated_media_extra_array[$index]))
				$media_extra_field[$key]['data'] = $formated_media_extra_array[$index];
		}
// var_dump($media_extra_field);exit;
		return $media_extra_field;
	}

	public function advancedSearch() {
		
	}

}