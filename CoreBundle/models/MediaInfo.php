<?php

require_once('Model.php');

class MediaInfo extends Model {

	public function __construct() {
		parent::__construct('media_info');
	}

	public function findAllMediaInfos() {
		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, episode_number, image_version, sound_version, handover_date, created_date, modified_date, id_media, id_language ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediaInfos: ' . $this->_mysqli->error : '',
		);
	}


	public function createNewMediaInfo($data) {
		$title = $this->_mysqli->real_escape_string($data['title_mediastorage']);
		$subtitle = $this->_mysqli->real_escape_string($data['subtitle_mediastorage']);
		$description = $this->_mysqli->real_escape_string($data['description_mediastorage']);
		$episode_number = $this->_mysqli->real_escape_string($data['episode_number_mediastorage']);
		$image_version = $this->_mysqli->real_escape_string($data['image_version_mediastorage']);
		$sound_version = $this->_mysqli->real_escape_string($data['sound_version_mediastorage']);
		$handover_date = $this->_mysqli->real_escape_string($data['handover_date_mediastorage']);
		$created_date = $this->_mysqli->real_escape_string($data['created_date_mediastorage']);
		$modified_date = $this->_mysqli->real_escape_string($data['modified_date_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(title, subtitle, description, episode_number, image_version, sound_version, handover_date, created_date, modified_date, id_media, id_language)' .
			' VALUES ("'. $title . '","'. $subtitle . '","'. $description . '","'. $episode_number . '","'. $image_version . '","'. $sound_version . '","'. $handover_date . '","'. $created_date . '","'. $modified_date . '", ' . $id_media . ', ' . $id_language . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMediaInfo: ' . $this->_mysqli->error : '',
		);
	}

	public function updateMediaInfoWithId($data, $media_info_id) {
		$title = $this->_mysqli->real_escape_string($data['title_mediastorage']);
		$subtitle = $this->_mysqli->real_escape_string($data['subtitle_mediastorage']);
		$description = $this->_mysqli->real_escape_string($data['description_mediastorage']);
		$episode_number = $this->_mysqli->real_escape_string($data['episode_number_mediastorage']);
		$image_version = $this->_mysqli->real_escape_string($data['image_version_mediastorage']);
		$sound_version = $this->_mysqli->real_escape_string($data['sound_version_mediastorage']);
		$handover_date = $this->_mysqli->real_escape_string($data['handover_date_mediastorage']);
		$created_date = $this->_mysqli->real_escape_string($data['created_date_mediastorage']);
		$modified_date = $this->_mysqli->real_escape_string($data['modified_date_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET title = "' . $title . '", subtitle = "' . $subtitle . '", description = "' . $description . '", episode_number = "' . $episode_number . '", image_version = "' . $image_version . '", sound_version = "' . $sound_version . '", handover_date = "' . $handover_date . '", created_date = "' . $created_date . '", modified_date = "' . $modified_date . '", id_media = ' . $id_media . ', id_language = ' . $id_language.
			' WHERE id = ' . $media_info_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaInfoWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoById($media_info_id) {
		$media_info_id = $this->_mysqli->real_escape_string($media_info_id);

		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, episode_number, image_version, sound_version, handover_date, created_date, modified_date, id_media, id_language' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $media_info_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaInfoById($media_info_id) {
		$media_info_id = $this->_mysqli->real_escape_string($media_info_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_info_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaInfoByMediaId($media_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_media = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoByMediaId: ' . $this->_mysqli->error : '',
		);
	}
}