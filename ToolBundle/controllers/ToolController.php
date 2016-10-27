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

	public function postProductionWorkFlow() {
		$id_task = $_POST['order_id'];
		$filepath = $_POST['filepath'];
		$filename = $_POST['filename'];
		$right_download = $_POST['right_download'];
		$right_preview = $_POST['right_preview'];
		$metadata = $_POST['metadata'];

		return $this->_workFlowManager->postProductionWorkFlow($task_id, $filepath, $filename, $right_download, $right_preview, $metadata);
	}

	public function endProductionWorkFlow() {
		$id_task = $_POST['order_id'];

		return $this->_workFlowManager->endProductionWorkFlow($id_task);
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