<?php

require_once('ToolBundle/models/WorkFlow.php');

class WorkFlowManager {

	private $_workFlowModel;

	public function __construct() {
		$this->_workFlowModel = new WorkFlowModel();
	}

	public function transcodingVideo($file_id, $input_file, $input_dir, $id_organization) {
		return $this->_workFlowModel->transcodingVideo($file_id, $input_file, $input_dir, $id_organization);
	}

	public function postProductionWorkFlow($id_file) {
		return $this->_workFlowModel->postProduction($id_file);
	}
}