<?php

require_once('CoreBundle/managers/InitManager.php');

class ToolController {

	private $_initManager;

	private $_errorArray;

	public function __construct() {
		$this->_initManager = new InitManager();;
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
			$this->_errorArray = array_merge($this->_errorArray, $data_array);
		}
	}

	public function useWorkFlow() {
		$input_file = $_GET['input_file'];
		$output_dir = $_GET['output_file'];
		//lancement de tache
		return ;
	}

	public function initDB() {
		$return = $this->_initManager->initMemoryChapterLanguageTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryFolderLanguageTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryMediaTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryMediaExtraTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryMediaExtraArrayTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryMediaFileTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryMediaInfoTableInDB();
		$this->mergeErrorArray($return);
		$return = $this->_initManager->initMemoryTagTableInDB();
		$this->mergeErrorArray($return);
		if (count($this->_errorArray) == 0) {
			header('Location:' . '?page=dashboard_root');
		}
		else {
			$i = 0;
			while (isset($this->_errorArray[$i])) {
				echo $this->_errorArray[$i];
				$i++;
			}
		}
	}

}

?>