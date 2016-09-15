<?php

require_once('CoreBundle/models/Search.php');

class SearchManager {

	private $_searchModel;

	public function __construct() {
		$this->_searchModel = new Search();
	}

	public function liveSearch($keyword, $id_organization, $id_language) {
		return $this->_searchModel->searchAll($keyword, $id_organization, $id_language);
	}

	public function quickSearch($keyword, $id_organization, $id_language) {
		return $this->_searchModel->searchAll($keyword, $id_organization, $id_language);
	}

	public function searchFolder($keyword) {
		return $this->_searchModel->searchFolder($keyword);
	}

}