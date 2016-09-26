<?php

require_once('Model.php');

class WorkFlowModel extends Model {

	private $_workflow_addr;
	private $_output_dir;
	private $_final_path;

	public function __construct() {
		parent::__construct('workflow');

		$this->_workflow_addr = 'http://46.218.167.91:8080/mw/wf_main_put.php';
		$this->_output_dir = '/var/www/html/mediastorage/file/';
		$this->_final_path = '/var/www/html/mediastorage/archive/';
	}

	public function transcodingVideo($id_file, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_file.', "video")');
		$post = array(
			'task_id_' => $data->num_rows,
			'file_in_' => $input_file,
			'path_in_' => $input_dir,
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path,
			'wfcode' => 'wf_video',
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingVideo: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingImage($id_file, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_file.', "image")');
		$post = array(
			'task_id_' => $data->num_rows,
			'file_in_' => $input_file,
			'path_in_' => $input_dir,
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path,
			'wfcode' => 'wf_image',
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingImage: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingOther($id_file, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_file.', "other")');
		$post = array(
			'task_id_' => $data->num_rows,
			'file_in_' => $input_file,
			'path_in_' => $input_dir,
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path,
			'wfcode' => 'wf_other',
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingOther: ' . $this->_mysqli->error : '',
		);
	}

	public function postProduction($task_id, $json) {
		//mise à jour base de donnée
		//$this->_mysqli->query();
	}

	private function exec_post($post) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->_workflow_addr);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		$result = curl_exec($ch);
		curl_close($ch);
		return ($result);
	}

}