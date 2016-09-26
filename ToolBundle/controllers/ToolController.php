<?php

require_once('CoreBundle/managers/InitManager.php');
require_once('ToolBundle/managers/WorkFlowManager.php');

class ToolController {

	private $_initManager;
	private $_workFlowManager;

	private $_errorArray;

	public function __construct() {
		$this->_initManager = new InitManager();
		$this->_workFlowManager = new WorkFlowManager();
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
		//$file_id = $_POST['task_id'];
		$input_file = $_POST['input_file'];
		$input_dir = $_POST['input_dir'];
		$id_organization = $_SESSION['id_organization'];

		return $this->_workFlowManager->transcodingVideo($file_id, $input_file, $input_dir, $id_organization);
	}

	public function postProductionWorkFlow() {
		$file_id = $_POST['task_id'];
		$wf_json = $_POST['json'];
		return $this->_workFlowManager->postProductionWorkFlow($file_id, $json);
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
		return ;
	}

}

?>