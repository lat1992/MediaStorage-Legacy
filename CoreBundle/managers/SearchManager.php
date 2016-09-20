<?php

require_once('CoreBundle/models/Search.php');

class SearchManager {

	private $_searchModel;

	public function __construct() {
		$this->_searchModel = new Search();
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

}