<?php

require_once('CoreBundle/models/Search.php');

class SearchManager {

	private $_searchModel;

	public function __construct() {
		$this->_searchModel = new Search();
	}

	public function quickSearch($keyword) {
		return $this->_searchModel->searchAll($keyword);
	}

	public function searchFolder($keyword) {
		return $this->_searchModel->searchFolder($keyword);
	}

}