<?php

require_once('ToolBundle/models/WorkFlow.php');

class WorkFlowManager {

	private $_workFlowModel;

	public function __construct() {
		$this->_workFlowModel = new WorkFlowModel();
	}

	public function transcoding($id_file, $file_path) {
		$wf_type = mime_content_type($file_path);
		if (strpos($wf_type, 'video'))
			return $this->_workFlowModel->transcodingVideo($id_file, pathinfo($file_path, PATHINFO_FILENAME), pathinfo($file_path, PATHINFO_DIRNAME), $_SESSION['id_organization']);
		else if (strpos($wf_type, 'image'))
			return $this->_workFlowModel->transcodingImage($id_file, pathinfo($file_path, PATHINFO_FILENAME), pathinfo($file_path, PATHINFO_DIRNAME), $_SESSION['id_organization']);
		else if (strpos($wf_type, 'audio'))
			return $this->_workFlowModel->transcodingAudio($id_file, pathinfo($file_path, PATHINFO_FILENAME), pathinfo($file_path, PATHINFO_DIRNAME), $_SESSION['id_organization']);
		else
			return $this->_workFlowModel->transcodingOther($id_file, pathinfo($file_path, PATHINFO_FILENAME), pathinfo($file_path, PATHINFO_DIRNAME), $_SESSION['id_organization']);
	}

	public function postProductionWorkFlow($task_id, $json) {
		return $this->_workFlowModel->postProduction($task_id, $json);
	}
}