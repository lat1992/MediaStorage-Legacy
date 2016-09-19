<?php

require_once('Model.php');

class Search extends Model {

	public function __construct() {
		parent::__construct('search');
	}

	public function getLiveSearch($keyword, $id_organization, $id_language) {
		$keyword = $this->_mysqli->real_escape_string($keyword);
		$data = $this->_mysqli->query(
			'SELECT memory_chapter_language.data FROM memory_chapter_language, chapter, memory_media WHERE memory_chapter_language.id_chapter = chapter.id AND chapter.id_media = memory_media.id AND memory_media.id_organization = '.$id_organization.' AND memory_chapter_language.id_language = '.$id_language.' AND memory_chapter_language.data LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_folder_language.data AS data FROM memory_folder_language, folder WHERE memory_folder_language.id_language = '.$id_language.' AND memory_folder_language.id_folder = folder.id AND folder.id_organization = '.$id_organization.' AND memory_folder_language.data LIKE "%'. $keyword .'%"'.
			' UNION '.
			'SELECT memory_media_extra.data FROM memory_media_extra, memory_media WHERE memory_media_extra.id_media = memory_media.id AND memory_media_extra.id_language = '.$id_language.' AND memory_media_extra.data LIKE "%'.$keyword.'%"'.
			' UNION '.
			'SELECT memory_media_extra_array.element AS data FROM memory_media_extra_array, media_extra_field, memory_media WHERE memory_media_extra_array.id_field = media_extra_field.id AND media_extra_field.id_organization = '.$id_organization.' AND memory_media_extra_array.id_language = '.$id_language.' AND memory_media_extra_array.element LIKE "%'.$keyword.'%"'.
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
			'error' => ($this->_mysqli->error) ? 'getLiveSearch: ' . $this->_mysqli->error : '',
			);
	}

	public function searchFolder($keyword, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT folder.id, memory_folder_language.data, memory_folder_language.description FROM  memory_folder_language, folder WHERE memory_folder_language.id_folder = folder.id AND folder.id_organization = '.$id_organization.' AND memory_folder_language.id_language = '.$id_language.' AND (memory_folder_language.data LIKE "%'.$keyword.'%" OR memory_folder_language.description LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchFolder: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMedia($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN chapter ON chapter.id_media = memory_media.id'.
			' JOIN memory_chapter_language ON chapter.id = memory_chapter_language.id_chapter'.
			' JOIN folder ON folder.id_media = memory_media.id'.
			' JOIN memory_folder_language ON memory_folder_language.id_folder = folder.id'.
			' JOIN media_extra_field ON media_extra_field.id_organization = memory_media.id_organization'.
			' JOIN memory_media_extra ON memory_media_extra.id_media = memory_media.id AND memory_media_extra.id_field = media_extra_field.id'.
			' JOIN memory_media_extra_array ON memory_media_extra_array.id_field = media_extra_field.id'.
			' JOIN memory_media_file ON memory_media_file.id_media = memory_media.id'.
			' JOIN tag ON tag.id_media = memory_media.id'.
			' JOIN memory_tag_language ON memory_tag_language.id_tag = tag.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND memory_chapter_language.id_language = '.$id_language.' AND memory_folder_language.id_language = '.$id_language.' AND memory_media_extra.id_language = '.$id_language.' AND memory_media_extra_array.id_language = '.$id_language.' AND memory_tag_language.id_language = '.$id_language.' AND '
			'(memory_chapter_language.data LIKE "%'.$keyword.'%" OR memory_folder_language.data LIEK "%'.$keyword.'%" OR memory_media.reference IS '.$keyword.' OR memory_media.reference_client LIKE "'.$keyword.'" OR memory_media_extra.data LIKE "%'.$keyword.'%" OR memory_media_extra_array.element LIKE "%'.$keyword.'%" OR memory_media_file.filename LIKE "%'.$keyword.'%" OR memory_media_info.title LIKE "%'.$keyword.'%" OR memory_media_info.subtitle LIKE "%'.$keyword.'%" OR media_info.description LIKE "%'.$keyword.'%" OR memory_tag_language.data LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMedia: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithTag($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN chapter ON chapter.id_media = memory_media.id'.
			' JOIN tag ON tag.id_media = memory_media.id'.
			' JOIN memory_tag_language ON memory_tag_language.id_tag = tag.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND memory_tag_language.id_language = '.$id_language.' AND '
			'(memory_tag_language.data LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithTag: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithFolder($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN folder ON folder.id_media = memory_media.id'.
			' JOIN memory_folder_language ON memory_folder_language.id_folder = folder.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_folder_language.id_language = '.$id_language.' AND '
			'(memory_folder_language.data LIEK "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithFolder: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithChapter($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN chapter ON chapter.id_media = memory_media.id'.
			' JOIN memory_chapter_language ON chapter.id = memory_chapter_language.id_chapter'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_chapter_language.id_language = '.$id_language.' AND '
			'(memory_chapter_language.data LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithChapter: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaInfoTitle($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND '
			'(memory_media_info.title LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaInfoTitle: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaInfoSubtitle($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND '
			'(memory_media_info.subtitle LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaInfoSubtitle: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaInfoDescription($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_info.id_language = '.$id_language.' AND '
			'(media_info.description LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaInfoDescription: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaExtra($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN memory_media_extra ON memory_media_extra.id_media = memory_media.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_extra.id_language = '.$id_language.' AND '
			'(memory_media_extra.data LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaExtra: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaExtraArray($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN media_extra_field ON media_extra_field.id_organization = memory_media.id_organization'.
			' JOIN memory_media_extra ON memory_media_extra.id_media = memory_media.id AND memory_media_extra.id_field = media_extra_field.id'.
			' JOIN memory_media_extra_array ON memory_media_extra_array.id_field = media_extra_field.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND memory_media_extra_array.id_language = '.$id_language.' AND '
			'(memory_media_extra_array.element LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaExtraArray: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaFile($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' JOIN memory_media_file ON memory_media_file.id_media = memory_media.id'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' '
			'(memory_media_file.filename LIKE "%'.$keyword.'%")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaFile: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaReference($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND '
			'(memory_media.reference IS '.$keyword.')'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaReference: ' . $this->_mysqli->error : '',
			);
	}

	public function searchMediaWithMediaReferenceClient($keyword, $id_type, $id_organization, $id_language, $paginate, $gap) {
		$data = $this->_mysqli->query('SELECT DISTINCT(memory_media.id), memory_media_info.title, memory_media_info.subtitle, media_info.description FROM  memory_media_info'.
			' JOIN media_info.id ON media_info.id = memory_media_info.id'.
			' JOIN memory_media ON memory_media.id = media_info.id_media'.
			' WHERE memory_media.id_type = '.$id_type.' AND memory_media.id_organization = '.$id_organization.' AND '
			'(memory_media.reference_client LIKE "'.$keyword.'")'.
			' LIMIT '$paginate * $gap - $gap','.$paginate * $gap.';'
			);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'searchMediaWithMediaReferenceClient: ' . $this->_mysqli->error : '',
			);
	}

}