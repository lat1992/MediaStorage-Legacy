<?php

require_once('Model.php');

class WorkFlowModel extends Model {

	private $_workflow_addr;
	private $_output_dir;
	private $_final_path;
	private $_input_dir;

	public function __construct() {
		parent::__construct('workflow');

		$settings = parse_ini_file('config.ini.php', true);
		$this->_workflow_addr = $settings['workflow']['url'];
		$this->_input_dir = $settings['storage']['input_path'];
		$this->_output_dir = $settings['storage']['output_path'];
		$this->_final_path = $settings['archive']['path'];
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

	public function transcodingVideo($id_media_file, $input_file, $input_dir, $output_file, $id_organization, $id_media) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "video" AND upload = 1 AND id_organization = '.$id_organization);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_media_file.', "video")');
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $input_file,
			'path_in_' => $this->_input_dir . $input_dir .'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $output_file,
			'path_out_' => $this->_output_dir . $id_organization.'/videos/',
			'path_final_' => $this->_final_path . $id_organization.'/'. $this->_mysqli->insert_id .'_',
			'thumbnail_path' => 'uploads/thumbnails/files/'.$id_organization.'/contents/',
			'thumbnail_file' => 'thumbnail_content_'.$id_media.'.png',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_video_default'),
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingVideo: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingImage($id_media_file, $input_file, $input_dir, $output_file, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "image" AND upload = 1 AND id_organization = '.$id_organization);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_media_file.', "image")');
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $input_file,
			'path_in_' => $this->_input_dir.$input_dir.'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $output_file,
			'path_out_' => $this->_output_dir.$id_organization.'/images/',
			'path_final_' => $this->_final_path.$id_organization.'/'. $this->_mysqli->insert_id .'_',
			'thumbnail_path' => 'uploads/thumbnails/files/'.$id_organization.'/contents/',
			'thumbnail_file' => 'thumbnail_content_'.$id_media.'.png',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_image_default'),
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingImage: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingAudio($id_media_file, $input_file, $input_dir, $output_file, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "audio" AND upload = 1 AND id_organization = '.$id_organization);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_media_file.', "audio")');
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $input_file,
			'path_in_' => $this->_input_dir.$input_dir.'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $output_file,
			'path_out_' => $this->_output_dir.$id_organization.'/audios/',
			'path_final_' => $this->_final_path.$id_organization .'/'. $this->_mysqli->insert_id .'_',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_audio_default'),
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingAudio: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingDocument($id_media_file, $input_file, $input_dir, $output_file, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "document" AND upload = 1 AND id_organization = '.$id_organization);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_media_file.', "document")');
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $input_file,
			'path_in_' => $this->_input_dir.$input_dir.'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $output_file,
			'path_out_' => $this->_output_dir.$id_organization.'/documents/',
			'path_final_' => $this->_final_path.$id_organization .'/'. $this->_mysqli->insert_id .'_',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_document_default'),
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingDocument: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodingOther($id_media_file, $input_file, $input_dir, $output_file, $id_organization) {
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE transcoding_type LIKE "other" AND upload = 1 AND id_organization = '.$id_organization);
		$profile = $data->fetch_assoc();
		$data_order = $this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$id_media_file.', "other")');
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $input_file,
			'path_in_' => $this->_input_dir.$input_dir.'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $output_file,
			'path_out_' => $this->_output_dir.$id_organization.'/others/',
			'path_final_' => $this->_final_path.$id_organization.'/'. $this->_mysqli->insert_id .'_',
			'wfcode' => (isset($profile['workflow_code']) ? $profile['workflow_code'] : 'ms_other_default'),
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodingOther: ' . $this->_mysqli->error : '',
		);
	}

	public function postProductionMaster($task_id, $filepath, $filename, $right_download, $right_preview, $metadata, $type) {
		$data = $this->_mysqli->query('SELECT id_media_file FROM workflow WHERE id = '. $task_id);
		$row_workflow = $data->fetch_assoc();
		if (isset($row_workflow['id_media_file'])) {
			$data = $this->_mysqli->query('SELECT id_media, id_organization FROM media_file WHERE id = '.$row_workflow['id_media_file']);
			$row = $data->fetch_assoc();
			if (isset($row['id_media'])) {
				$mime = mime_content_type('/var/www/html/mediastorage/'. $filepath . $filename);
				$data = $this->_mysqli->query('UPDATE media_file SET id_organization = '. $row['id_organization'] .', filename = "'.$filename.'", filepath = "'.$filepath.$filename.'", right_download = '.$right_download.', right_preview = '.$right_preview .', metadata = "'.$metadata.'", type = "'.$type.'", mime_type = "'.$mime.'" WHERE id = '. $row_workflow['id_media_file'] );
			}
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'postProductionMaster: ' . $this->_mysqli->error : '',
		);
	}

	public function postProduction($task_id, $filepath, $filename, $right_download, $right_preview, $metadata, $type) {
		$data = $this->_mysqli->query('SELECT id_media_file FROM workflow WHERE id = '. $task_id);
		$row = $data->fetch_assoc();
		if (isset($row['id_media_file'])) {
			$data = $this->_mysqli->query('SELECT id_media, id_organization FROM media_file WHERE id = '.$row['id_media_file']);
			$row = $data->fetch_assoc();
			if (isset($row['id_media'])) {
				$mime = mime_content_type('/var/www/html/mediastorage/'.$filepath . $filename);
				$data = $this->_mysqli->query('INSERT INTO media_file (id_organization, id_media, filename, filepath, right_download, right_preview, metadata, mime_type, type) VALUES ('. $row['id_organization'] .', '. $row['id_media'] .', "'. $filename .'", "'. $filepath.$filename .'", '.$right_download.', '.$right_preview.', "'.$metadata.'", "'. $mime .'", "'.$type.'")');
			}
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

	public function findWorkFlowProfileWithIdOrganization($id_organization, $type, $mode) {
		$data = $this->_mysqli->query('SELECT * FROM workflow_organization WHERE id_organization = '.$id_organization . ' AND transcoding_type LIKE "'.$type.'" AND `mode` = '. $mode);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findWorkFlowProfileWithIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodeWithProfile($cart_transcode) {
		$cart = $cart_transcode->fetch_assoc();
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE upload = 1 AND id_organization = '.$_SESSION['id_organization'].' AND id = '. $cart['id_workflow']);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('SELECT * FROM media_file WHERE id = '.$cart['id_media_file']);
		$media_file = $data->fetch_assoc();
		$this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$cart['id_media_file'].', "transcode")');
		$path = pathinfo($media_file['filepath']);
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $path['basename'],
			'path_in_' => $path['dirname'] .'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $path['basename'],
			'path_out_' => $this->_output_dir . $_SESSION['id_organization'] .'/transcodes/',
			'wfcode' => $profile['workflow_code'],
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodeWithProfile: ' . $this->_mysqli->error : '',
		);
	}

	public function cutWithWorkFlow($cart_cut) {
		$cart = $cart_cut->fetch_assoc();
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE upload = 1 AND id_organization = '.$_SESSION['id_organization']);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('SELECT * FROM media_file WHERE id = '.$cart['id_media_file']);
		$media_file = $data->fetch_assoc();
		$this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$cart['id_media_file'].', "transcode")');
		$path = pathinfo($media_file['filepath']);
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $path['basename'],
			'path_in_' => $path['dirname'] .'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $path['basename'],
			'path_out_' => $this->_output_dir . $_SESSION['id_organization'].'/transcodes/',
			'tc_in' => $cart['tc_in'],
			'tc_out' => $cart['tc_out'],
			'wfcode' => "mediastorage_cut_video",
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'cutWithProfile: ' . $this->_mysqli->error : '',
		);
	}

	public function transcodeCutWithProfile($cart_transcode_cut) {
		$cart = $cart_transcode_cut->fetch_assoc();
		$data = $this->_mysqli->query('SELECT workflow_code FROM workflow_organization WHERE upload = 1 AND id_organization = '.$_SESSION['id_organization'].' AND id = '. $cart['id_workflow']);
		$profile = $data->fetch_assoc();
		$data = $this->_mysqli->query('SELECT * FROM media_file WHERE id = '.$cart['id_media_file']);
		$media_file = $data->fetch_assoc();
		$this->_mysqli->query('INSERT INTO '.$this->_table.
			' (id_media_file, transcoding_type) VALUES'.
			' ('.$cart['id_media_file'].', "transcode")');
		$path = pathinfo($media_file['filepath']);
		$post = array(
			'order_id_' => $this->_mysqli->insert_id,
			'platform' => $_GET['platform'],
			'file_in_' => $path['basename'],
			'path_in_' => $path['dirname'] .'/',
			'file_out_' => $this->_mysqli->insert_id .'_' . $path['basename'],
			'path_out_' => $this->_output_dir . $_SESSION['id_organization'].'/transcodes/',
			'tc_in' => $cart['tc_in'],
			'tc_out' => $cart['tc_out'],
			'wfcode' => $profile['workflow_code'],
			'validWf' => 'ok'
		);
		return array(
			'data' => $this->exec_post($post),
			'error' => ($this->_mysqli->error) ? 'transcodeCutWithProfile: ' . $this->_mysqli->error : '',
		);
	}

}