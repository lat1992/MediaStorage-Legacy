<?php

require_once('Model.php');

class Media extends Model {

	public function __construct() {
		parent::__construct('media');
	}

	public function findAllMedias() {
		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization FROM ' . $this->_table . ';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMedias: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllmediasByIdOrganizationAndIdTypeNoLimit($id_organization, $id_type, $user_id_language) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view ,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization . ' AND id_type = ' . $id_type
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllmediasByIdOrganizationAndIdType($id_organization, $id_type, $user_id_language, $offset, $size) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view ,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization . ' AND id_type = ' . $id_type .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}


	public function getAllMediasCount($id_organization, $id_type, $user_id_language) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT COUNT(*) as count
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization .
			' AND id_type = ' . $id_type
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'getAllMediasCount: ' . $this->_mysqli->error : '',
		);
	}

	public function getAllMediasCountByIdParent($id_organization, $id_type, $user_id_language, $id_parent) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_parent = $this->_mysqli->real_escape_string($id_parent);

		if ($id_parent) {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count
				 FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_type = ' . $id_type .
				' AND id_parent = ' . $id_parent
			);
		}
		else {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count
				 FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_type = ' . $id_type .
				' AND id_parent IS NULL'
			);
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'getAllMediasCountByIdParent: ' . $this->_mysqli->error : '',
		);
	}

	public function getAllMediasCountByIdFolder($id_organization, $id_type, $id_folder) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_folder = $this->_mysqli->real_escape_string($id_folder);

		if ($id_folder) {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count
				 FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_type = ' . $id_type .
				' AND id_folder = ' . $id_folder
			);
		}
		else {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count
				 FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_type = ' . $id_type .
				' AND id_folder IS NULL'
			);
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'getAllMediasCountByIdFolder: ' . $this->_mysqli->error : '',
		);
	}


	// public function findAllMediasByIdOrganizationAndIdTypeAndFolderId($id_organization, $id_type, $id_folder) {
	// 	$id_type = $this->_mysqli->real_escape_string($id_type);
	// 	$id_organization = $this->_mysqli->real_escape_string($id_organization);
	// 	$id_folder = $this->_mysqli->real_escape_string($id_folder);

	// 	$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view FROM ' . $this->_table .
	// 		' WHERE id_organization = ' . $id_organization . ' AND id_type = ' . $id_type . ' AND id_folder = ' . $id_folder .
	// 		';');

	// 	return array(
	// 		'data' => $data,
	// 		'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
	// 	);
	// }

	public function findProgramWithContentIdFolder($id_organization, $id_type, $id_folder, $user_id_language, $offset, $size) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_folder = $this->_mysqli->real_escape_string($id_folder);
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT media.id, media.id_parent, media.reference, media.id_type, media.id_organization, media.reference_client, media.right_view,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' LEFT JOIN media s1 ON media.id = s1.id_parent' .
			' WHERE media.id_organization = ' . $id_organization .
			' AND media.id_type = ' . $id_type .
			' AND s1.id_folder = ' . $id_folder .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);

	}

	public function findAllMediasByIdOrganizationAndIdTypeAndFolderId($id_organization, $id_type, $id_folder, $user_id_language, $offset, $size) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_folder = $this->_mysqli->real_escape_string($id_folder);
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization . ' AND id_folder = ' . $id_folder . ' AND id_type = ' . $id_type .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMediasByIdOrganizationAndIdTypeAndParentId($id_organization, $id_type, $id_parent, $user_id_language, $offset, $size) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_parent = $this->_mysqli->real_escape_string($id_parent);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization . ' AND id_type = ' . $id_type . ' AND id_parent = ' . $id_parent .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMediasByIdOrganizationAndIdTypeAndParentIdAndFolderId($id_organization, $id_type, $id_parent, $id_folder, $user_id_language, $offset, $size) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_parent = $this->_mysqli->real_escape_string($id_parent);
		$id_folder = $this->_mysqli->real_escape_string($id_folder);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization .
			' AND id_type = ' . $id_type .
			' AND id_parent = ' . $id_parent .
			' AND id_folder = ' . $id_folder .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllMediasWithoutParentsByIdOrganizationAndIdType($id_organization, $id_type, $user_id_language) {
		$id_type = $this->_mysqli->real_escape_string($id_type);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, reference, id_type, id_organization, reference_client, right_view,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization . ' AND id_type = ' . $id_type . ' AND id_parent IS NULL' .
			';');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllMediasByIdOrganization: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewMedia($data) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$reference_client = $this->_mysqli->real_escape_string($data['reference_client_mediastorage']);
		$right_view = $this->_mysqli->real_escape_string($data['right_view_mediastorage']);
		$created_date = $this->_mysqli->real_escape_string($data['created_date_mediastorage']);
		$modified_date = $this->_mysqli->real_escape_string($data['modified_date_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_parent, id_folder, id_organization, id_type, reference, reference_client, right_view, created_date, modified_date)' .
			' VALUES (' . $id_parent . ', ' . $id_folder . ', ' . $id_organization . ', ' . $id_type .', "' . $reference . '", "' . $reference_client . '", ' . $right_view . ',"'. $created_date . '","'. $modified_date . '");'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewMedia: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id
		);
	}

	public function updateMediaWithId($data, $media_id) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_folder = $this->_mysqli->real_escape_string($data['id_folder_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);
		$id_type = $this->_mysqli->real_escape_string($data['id_type_mediastorage']);
		//$reference = $this->_mysqli->real_escape_string($data['reference_mediastorage']);
		$right_view = $this->_mysqli->real_escape_string($data['right_view_mediastorage']);
		$modified_date = $this->_mysqli->real_escape_string($data['modified_date_mediastorage']);
		$reference_client = $this->_mysqli->real_escape_string($data['reference_client_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
		' SET id_parent = ' . $id_parent . ', id_folder = ' . $id_folder . ', id_organization = ' . $id_organization . ', id_type = ' . $id_type . ', reference_client = "' . $reference_client . '", right_view = ' . $right_view . ', modified_date = "' . $modified_date . '" ' .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateMediaWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function updateFolderWithNullById($folder_id) {
		$data = $this->_mysqli->query('UPDATE '. $this->_table .' SET id_folder = NULL WHERE id_folder = '. $folder_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderWithNullById: ' . $this->_mysqli->error : '',
		);
	}

	public function updateParentMediaWithNullById($media_id) {
		$data = $this->_mysqli->query('UPDATE '. $this->_table .' SET id_parent = NULL WHERE id_parent = '. $media_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateParentMediaWithNullById: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaById($media_id, $user_id_language) {
		$media_id = $this->_mysqli->real_escape_string($media_id);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_folder, id_organization, id_type, reference, reference_client, right_view, created_date, modified_date,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate,
			 IF ((SELECT id FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $user_id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS subtitle_translate
			 FROM ' . $this->_table .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function findMediaByidAndOrganizationId($id_media, $id_organization) {
		$id_media = $this->_mysqli->real_escape_string($id_media);
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_folder, id_organization, id_type, reference, reference_client, right_view, created_date, modified_date ' .
			' FROM ' . $this->_table .
			' WHERE id = ' . $id_media . ' AND id_organization = ' . $id_organization . ' ;'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findMediaById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteMediaById($media_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $media_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteMediaById:' . $this->_mysqli->error : '',
		);
	}

	public function findLastRefenceNumberByOrganization($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT MAX(reference) AS reference FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findLastRefenceNumberByOrganization:' . $this->_mysqli->error : '',
		);
	}
}