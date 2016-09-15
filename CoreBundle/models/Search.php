<?php

require_once('Model.php');

class Search extends Model {

	public function __construct() {
		parent::__construct('search');
	}

	public function getLiveSearch($keyword, $id_organization, $id_language) {
		$data = $this->_mysqli->query(
			'SELECT memory_chapter_language.data FROM memory_chapter_language, chapter, memory_media WHERE memory_chapter_language.id_chapter = chapter.id AND chapter.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_chapter_language.id_language = '.$id_language.' AND memory_chapter_language.data LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_folder_language.data AS data FROM memory_folder_language, folder WHERE memory_folder_language.id_language = '.$id_language.' AND memory_folder_language.id_folder = folder.id AND folder.id_organization = '.$id_organization.' AND memory_folder_language.data LIKE "%'. $keyword .'%"'.
			' UNION '.
			'SELECT memory_media_extra.data FROM memory_media_extra, memory_media WHERE memory_media_extra.id_media = memory_media.id AND memory_media_extra.id_language = '.$id_language.' AND memory_media_extra.data LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_media_extra_array.element AS data FROM memory_media_extra_array, media_extra_field, memory_media WHERE memory_media_extra_array.id_field = media_extra_field.id AND media_extra_field.id_organization = '.$id_organization.' AND memory_media_extra_array.id_language = '.$id_language.' AND memory_media_extra_array.element LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_media_extra_field_language.data FROM memory_media_extra_field_language, media_extra_field WHERE memory_media_extra_field_language.id_field = media_extra_field.id AND memory_media_extra_field_language.id_language = '.$id_language.' AND media_extra_field.id_organization = '.$id_organization.' AND memory_media_extra_field_language.data LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_media_info.title AS data FROM memory_media_info, memory_media WHERE memory_media_info.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND memory_media_info.title LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_media_info.subtitle AS data FROM memory_media_info, memory_media WHERE memory_media_info.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND memory_media_info.subtitle LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_tag_language.data FROM memory_tag_language, tag, memory_media WHERE memory_tag_language.id_tag = tag.id AND tag.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_tag_language.id_language = '.$id_language.' AND memory_tag_language.data LIKE "%'.$keyword.'%"'.
			' ORDER BY (CASE WHEN data LIKE "'.$keyword.'%" THEN 1 WHEN data REGEXP "[0-9]+" THEN 3 ELSE 2 END), data ASC LIMIT 0,10;'
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