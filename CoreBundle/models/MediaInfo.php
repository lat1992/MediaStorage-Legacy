<?php

require_once('Model.php');

class MediaInfo extends Model {

	public function __construct() {
		parent::__construct('media_info');
	}

	public function findAllMediaInfos() {
		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, id_media, id_language ' .
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
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(title, subtitle, description, id_media, id_language)' .
			' VALUES ("'. $title . '","'. $subtitle . '","'. $description . '", ' . $id_media . ', ' . $id_language . ');'
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
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$id_language = $this->_mysqli->real_escape_string($data['id_language_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET title = "' . $title . '", subtitle = "' . $subtitle . '", description = "' . $description . '", id_media = ' . $id_media . ', id_language = ' . $id_language.
			' WHERE id = ' . $media_info_id . ';'
		);
		/*echo 'UPDATE ' . $this->_table .
			' SET title = "' . $title . '", subtitle = "' . $subtitle . '", description = "' . $description . '", id_media = ' . $id_media . ', id_language = ' . $id_language.
			' WHERE id = ' . $media_info_id . ';';
		exit;*/

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaInfoWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoById($media_info_id) {
		$media_info_id = $this->_mysqli->real_escape_string($media_info_id);

		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, id_media, id_language' .
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

	public function deleteMediaInfoByLanguageId($language_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id_language = ' . $language_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaInfoByLanguageId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoByMediaId($id_media) {
		$id_media = $this->_mysqli->real_escape_string($id_media);

		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, id_media, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_media = ' . $id_media . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoByMediaId: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaInfoByMediaIdAndLanguageId($id_media, $id_language) {
		$id_media = $this->_mysqli->real_escape_string($id_media);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT id, title, subtitle, description, id_media, id_language' .
									' FROM ' . $this->_table .
									' WHERE id_media = ' . $id_media . ' AND id_language = ' . $id_language . ' ;'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaInfoByMediaId: ' . $this->_mysqli->error : '',
		);
	}

}