<?php

require_once('Model.php');

class Folder extends Model {

	public function __construct() {
		parent::__construct('folder');
	}

	public function findAllFolders($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolders: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllFoldersWithLimit($id_organization, $offset, $size) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization .
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolders: ' . $this->_mysqli->error : '',
		);
	}

	public function getAllFoldersCount($id_organization) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT COUNT(*) as count ' .
			' FROM ' . $this->_table .
			' WHERE id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'getAllFoldersCount: ' . $this->_mysqli->error : '',
		);
	}

	public function getAllFoldersCountByIdParent($id_organization, $id_parent) {
		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$id_parent = $this->_mysqli->real_escape_string($id_parent);

		if ($id_parent) {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count ' .
				' FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_parent = ' . $id_parent
			);
		}
		else {
			$data = $this->_mysqli->query('SELECT COUNT(*) as count ' .
				' FROM ' . $this->_table .
				' WHERE id_organization = ' . $id_organization .
				' AND id_parent IS NULL'
			);
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolders: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewFolder($data) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_parent, id_organization)' .
			' VALUES ('. $id_parent . ', ' . $id_organization . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewFolder: ' . $this->_mysqli->error : '',
			'id' => $this->_mysqli->insert_id,
		);
	}

	public function updateFolderWithId($data, $folder_id) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', id_parent = ' . $id_parent . '' .
			' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function updateFolderWithIdAsAdmin($data, $folder_id) {
		$id_parent = $this->_mysqli->real_escape_string($data['id_parent_mediastorage']);
		$id_organization = $this->_mysqli->real_escape_string($data['id_organization_mediastorage']);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_organization = ' . $id_organization . ', id_parent = ' . $id_parent .
			' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateFolderWithId: ' . $this->_mysqli->error : '',
		);
	}


	public function findFolderById($folder_id, $id_language) {
		$folder_id = $this->_mysqli->real_escape_string($folder_id);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findFolderById: ' . $this->_mysqli->error : '',
		);
	}

	public function updateParentFolderWithNullById($folder_id) {
		$data = $this->_mysqli->query('UPDATE '. $this->_table .' SET id_parent = NULL WHERE id_parent = '. $folder_id);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateParentFolderWithNullById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteFolderById($folder_id) {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $folder_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteFolderById: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllFolderWithoutParentsByOrganizationWithLimit($id_organization, $user_language_id, $offset, $size) {

		$id_organization = $this->_mysqli->real_escape_string($id_organization);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);
		$id_language = $this->_mysqli->real_escape_string($_SESSION['id_language_mediastorage']);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_parent IS NULL AND id_organization = ' . $id_organization .' AND id_language = '.$id_language
			' LIMIT ' . $offset . ', ' . $size
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolderWithoutParentsByOrganizationWithLimit: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllFolderWithoutParentsByOrganization($id_organization, $user_language_id) {

		$id_organization = $this->_mysqli->real_escape_string($id_organization);

		$data = $this->_mysqli->query('SELECT id, id_parent, id_organization, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_parent IS NULL AND id_organization = ' . $id_organization
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolderWithoutParentsByOrganization: ' . $this->_mysqli->error : '',
		);
	}


	public function findAllFolderWithParentIdAndOrganizationWithLimit($parent_id, $organization_id, $user_language_id, $offset, $size) {

		$parent_id = $this->_mysqli->real_escape_string($parent_id);
		$organization_id = $this->_mysqli->real_escape_string($organization_id);
		$offset = $this->_mysqli->real_escape_string($offset);
		$size = $this->_mysqli->real_escape_string($size);

		$data = $this->_mysqli->query('SELECT id, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_parent = ' . $parent_id . ' AND id_organization = ' . $organization_id .
			' LIMIT ' . $offset . ', ' . $size

		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolderWithParentId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllFolderWithParentIdAndOrganization($parent_id, $organization_id, $user_language_id) {

		$parent_id = $this->_mysqli->real_escape_string($parent_id);
		$organization_id = $this->_mysqli->real_escape_string($organization_id);

		$data = $this->_mysqli->query('SELECT id, IF ((SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1) IS NOT NULL,(SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = ' . $user_language_id . ' LIMIT 1), (SELECT data FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate, IF ((SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1) IS NOT NULL,(SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id AND id_language = 3 LIMIT 1), (SELECT description FROM folder_language WHERE folder_language.id_folder = folder.id LIMIT 1)) AS translate_description ' .
			' FROM ' . $this->_table .
			' WHERE id_parent = ' . $parent_id . ' AND id_organization = ' . $organization_id
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllFolderWithParentId: ' . $this->_mysqli->error : '',
		);
	}

}