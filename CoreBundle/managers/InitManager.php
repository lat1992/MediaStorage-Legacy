<?php

require_once('CoreBundle/models/Init.php');

class InitManager {

	private $_initModel;

	public function __construct() {
		$this->_initModel = new InitModel();
	}

	public function initMemoryChapterLanguageTableInDB() {
		return $this->_initModel->initChapterLanguage();
	}

	public function initMemoryFolderLanguageTableInDB() {
		return $this->_initModel->initFolderLanguage();
	}

	public function initMemoryMediaTableInDB() {
		return $this->_initModel->initMedia();
	}

	public function initMemoryMediaExtraTableInDB() {
		return $this->_initModel->initMediaExtra();
	}

	public function initMemoryMediaExtraArrayTableInDB() {
		return $this->_initModel->initMediaExtraArray();
	}

	public function initMemoryMediaFileTableInDB() {
		return $this->_initModel->initMediaFile();
	}

	public function initMemoryMediaInfoTableInDB() {
		return $this->_initModel->initMediaInfo();
	}

	public function initMemoryTagTableInDB() {
		return $this->_initModel->initTag();
	}

}