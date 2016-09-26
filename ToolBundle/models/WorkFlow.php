<?php

require_once('Model.php');

class WorkFlowModel extends Model {

	private $workflow_addr;
	private $output_dir;

	public function __construct() {
		parent::__construct('workflow');

		$this->workflow_addr = 'http://46.218.167.91:8080/mw/wf_main_put.php';
		$this->output_dir = '/var/www/html/mediastorage/file/';
	}

	public function transcodingVideo($file_id, $input_file, $input_dir, $id_organization) {
		$post = array(
			'task_id_' => $file_id,
			'file_in_' => $input_file,
			'path_in_' => $input_dir,
			'file_out_' => $input_file,
			'path_out_' => $this->output_dir.$id_organization.'/',
			'path_final_' => ''
		);
		return exec_post($post);
	}

	public function postProduction($id_file, $json) {
		//mise à jour base de donnée
		//$this->_mysqli->query();
	}

	private function exec_post($post) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->workflow_addr);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$result = curl_exec($ch); 
		curl_close($ch);
		return ($result);
	}

}