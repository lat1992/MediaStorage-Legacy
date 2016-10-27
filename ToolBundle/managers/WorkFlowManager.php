<?php

require_once('ToolBundle/models/WorkFlow.php');

class WorkFlowManager {

	private $_workFlowModel;

	public function __construct() {
		$this->_workFlowModel = new WorkFlowModel();
	}

	public function transcoding($id_file, $file_path) {
		$wf_type = mime_content_type($file_path);
		if (strpos($wf_type, 'video') !== false)
			return $this->_workFlowModel->transcodingVideo($id_file, pathinfo($file_path, PATHINFO_BASENAME), pathinfo($file_path, PATHINFO_DIRNAME), pathinfo($file_path, PATHINFO_FILENAME), $_SESSION['id_organization']);
		else if (strpos($wf_type, 'image') !== false)
			return $this->_workFlowModel->transcodingImage($id_file, pathinfo($file_path, PATHINFO_BASENAME), pathinfo($file_path, PATHINFO_DIRNAME), pathinfo($file_path, PATHINFO_FILENAME), $_SESSION['id_organization']);
		else if (strpos($wf_type, 'audio') !== false)
			return $this->_workFlowModel->transcodingAudio($id_file, pathinfo($file_path, PATHINFO_BASENAME), pathinfo($file_path, PATHINFO_DIRNAME), pathinfo($file_path, PATHINFO_FILENAME), $_SESSION['id_organization']);
		else
			return $this->_workFlowModel->transcodingOther($id_file, pathinfo($file_path, PATHINFO_BASENAME), pathinfo($file_path, PATHINFO_DIRNAME), pathinfo($file_path, PATHINFO_FILENAME), $_SESSION['id_organization']);
	}

	public function transcodeCart() {
		
	}

	public function postProductionWorkFlow($task_id, $filepath, $filename, $right_download, $right_preview, $metadata) {
		return $this->_workFlowModel->postProduction($task_id, $filepath, $filename, $right_download, $right_preview, $metadata);
	}

	public function endProductionWorkFlow($task_id) {
		return $this->_workFlowModel->endProduction($task_id);
	}
}