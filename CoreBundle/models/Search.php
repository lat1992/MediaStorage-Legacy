<?php

require_once('Model.php');

class Search extends Model {

	public function __construct() {
		parent::__construct('search');
	}

	public function searchAll($keyword, $id_organization, $id_language) {
		$data = $this->_mysqli->query(
			'SELECT data FROM memory_folder_language WHERE id_language = '.$id_language.' AND memory_folder_language.id_chapter = folder.id AND folder.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_folder_language.data LIKE "%'. $keyword .'%"'.

			' UNION SELECT data FROM memory_chapter_language WHERE id_language = '.$id_language.' AND data LIKE "%'.$keyword.'%"'.
			' UNION SELECT data FROM memory_media_extra WHERE id_language = '.$id_language.' AND data LIKE "%'.$keyword.'%"'.
			' UNION SELECT element AS data FROM memory_media_extra_array WHERE id_language = '.$id_language.' AND element LIKE "%'.$keyword.'%"'.
			' UNION SELECT data FROM memory_media_extra_field_language WHERE id_language = '.$id_language.' AND data LIKE "%'.$keyword.'%"'.
			' UNION SELECT title AS data FROM memory_media_info WHERE id_language = '.$id_language.' AND title LIKE "%'.$keyword.'%"'.
			' UNION SELECT subtitle AS data FROM memory_media_info WHERE id_language = '.$id_language.' AND subtitle LIKE "%'.$keyword.'%"'.
			' UNION SELECT data FROM memory_tag_language WHERE id_language = '.$id_language.' AND data LIKE "%'.$keyword.'%" ORDER BY ASC'
		);
		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchAll: ' . $this->_mysqli->error : '',
			);
	}

	public function searchFolder($keyword) {
		$data = $this->_mysqli->query('SELECT id, data, description FROM  memory_folder_language WHERE data LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%"');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchFolder: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMedia($keyword, $id_type, $id_organization, $id_language) {
		$data = $this->_mysqli->query('SELECT id, data, description FROM  memory_media, memory_media_info WHERE memory_media.id_media = memory_media_info.id AND id_language = '.$id_language.' AND id_organization = '.$id_organization.' id_type = '.$id_type.' AND (data LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchFolder: ' . $this->_mysqli->error : '',
			);
	}

}