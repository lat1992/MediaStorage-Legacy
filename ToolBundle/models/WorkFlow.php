<?php

require_once('Model.php');

class WorkFlowModel extends Model {

	private $_workflow_addr;
	private $_output_dir;
	private $_final_path;

	public function __construct() {
		parent::__construct('workflow');

		$settings = parse_ini_file('config.ini.php', true);
		$this->_workflow_addr = $settings['workflow']['url'];
		$this->_output_dir = $settings['storage']['path'];
		$this->_final_path = $settings['archive']['path'];
	}

	public function transcodingVideo($id_media, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "video" AND upload = 1');
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media, id_organizatoin, transcoding_type) VALUES'.
			' ('.$id_media.', "video")');
		$post = array(
			'order_id_' => $data->insert_id,
			'file_in_' => $input_file,
			'path_in_' => $input_dir.'/',
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path.$id_organization.'/',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_video_default'),
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingVideo: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingImage($id_media, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "image" AND upload = 1');
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media, transcoding_type) VALUES'.
			' ('.$id_media.', "image")');
		$post = array(
			'order_id_' => $data->insert_id,
			'file_in_' => $input_file,
			'path_in_' => $input_dir.'/',
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path.$id_organization.'/',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_image_default'),
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingImage: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingAudio($id_media, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "audio" AND upload = 1');
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media, transcoding_type) VALUES'.
			' ('.$id_media.', "audio")');
		$post = array(
			'order_id_' => $data->insert_id,
			'file_in_' => $input_file,
			'path_in_' => $input_dir.'/',
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path.$id_organization.'/',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_audio_default'),
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingAudio: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingOther($id_media, $input_file, $input_dir, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "other" AND upload = 1');
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media, transcoding_type) VALUES'.
			' ('.$id_media.', "other")');
		$post = array(
			'order_id_' => $data->insert_id,
			'file_in_' => $input_file,
			'path_in_' => $input_dir.'/',
			'file_out_' => $input_file,
			'path_out_' => $this->_output_dir.$id_organization.'/',
			'path_final_' => $this->_final_path.$id_organization.'/',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_other_default'),
			'validwf' => 'ok'
		);
		return array(
			'data' => exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingOther: ' . $this->_mysqli->error : '',
		);
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

	public function postProduction($task_id, $filepath, $filename, $right_download, $right_preview, $metadata) {
		$data = $this->_mysqli->query('SELECT id_media FROM workflow WHERE id = '. $task_id);
		$row = $data->fetch_assoc();
		if (isset($row['id_media'])) {
			$mime = mime_content_type($filepath . $filename);
			$data = $this->_mysqli->query('INSERT INTO media_file (id_media, filename, filepath, right_download, right_preview, metadata, mime_type) VALUES ('. $row['id_media'] .', "'. $filename .'", "'. $filepath .'", '.$right_download.', '.$right_preview.', "'.$metadata.'", "'. $mime_type .'")');
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'postProduction: ' . $this->_mysqli->error : '',
		);
	}

	public function endProduction($task_id) {
		$data = $this->_mysqli->query('DELETE FROM '.$this->_table.' WHERE id = '.$task_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'endProduction: ' . $this->_mysqli->error : '',
		);
	}

}