<?php

require_once('Model.php');

class Cart extends Model {

	public function __construct() {
		parent::__construct('cart');
	}

	public function findAllCarts() {
		$data = $this->_mysqli->query('SELECT id, id_user, id_media_file ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllCarts: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllCartsByUserId($id_user, $id_language) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$id_language = $this->_mysqli->real_escape_string($id_language);

		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, cart.type, media_file.filename, cart.tc_in, cart.tc_out, media.id as id_media,'.
			' IF ((SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT title FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT title FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate_title,' .
			' IF ((SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT subtitle FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT subtitle FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate_subtitle,'.
			' IF ((SELECT description FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1) IS NOT NULL,(SELECT description FROM media_info WHERE media_info.id_media = media.id AND id_language = ' . $id_language . ' LIMIT 1), (SELECT description FROM media_info WHERE media_info.id_media = media.id LIMIT 1)) AS translate_description'.
			' FROM ' . $this->_table .
			' LEFT JOIN media_file ON media_file.id = cart.id_media_file' .
			' LEFT JOIN media ON media.id = media_file.id_media' .
 			' WHERE id_user = ' . $id_user
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllCartsByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllDeliveryByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, cart.comment FROM cart'.
			' WHERE cart.type LIKE "Delivery" AND cart.id_user = '.$id_user);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllDeliveryById: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllCutByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, cart.tc_in, cart.tc_out FROM cart'.
			' WHERE cart.tc_in IS NOT NULL AND cart.tc_out IS NOT NULL AND cart.id_workflow IS NULL AND cart.id_user = '.$id_user);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllCutByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllDownloadByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, media_file.filename, media_file.type, user_download_token.token, user_download_token.date FROM cart'.
			' LEFT JOIN media_file ON cart.id_media_file = media_file.id'.
			' LEFT JOIN user_download_token ON user_download_token.id_media_file = media_file.id'.
			' WHERE cart.type LIKE "Download" AND cart.tc_in IS NULL AND cart.tc_out IS NULL AND id_workflow IS NULL AND cart.id_user = '.$id_user .' GROUP BY (cart.id)');

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllDownloadByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllTranscodeByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, cart.id_workflow FROM cart'.
			' WHERE cart.id_workflow IS NOT NULL AND cart.tc_in IS NULL AND cart.tc_out IS NULL AND cart.id_user = '.$id_user);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllTranscodeByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllTranscodeCutByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT cart.id, cart.id_user, cart.id_media_file, cart.id_workflow FROM cart'.
			' WHERE cart.id_workflow IS NOT NULL AND cart.tc_in IS NOT NULL AND cart.tc_out IS NOT NULL AND cart.id_user = '.$id_user);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllTranscodeByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function findAllDownloadHistoryByUserId($id_user) {
		$id_user = $this->_mysqli->real_escape_string($id_user);
		$data = $this->_mysqli->query('SELECT media_file.filename, user_download_token.token, user_download_token.date FROM user_download_token'.
			' LEFT JOIN media_file ON user_download_token.id_media_file = media_file.id'.
			' WHERE user_download_token.id_user = '.$id_user);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllDownloadHistoryByUserId: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewCart($id_user, $id_media_file, $mode, $wf, $comment, $tc_in, $tc_out) {
		if ($tc_in == "") {
			$tc_in = 'NULL';
		}
		if ($tc_out == "") {
			$tc_out = 'NULL';
		}

		$id_user = $this->_mysqli->real_escape_string($id_user);
		$id_media_file = $this->_mysqli->real_escape_string($id_media_file);
		$wf = $this->_mysqli->real_escape_string($wf);
		$mode = $this->_mysqli->real_escape_string($mode);
		$comment = $this->_mysqli->real_escape_string($comment);
		$tc_in = $this->_mysqli->real_escape_string($tc_in);
		$tc_out = $this->_mysqli->real_escape_string($tc_out);


		if (strcmp($mode, 'Download') !== false) {
			$result = $this->_mysqli->query('INSERT INTO user_download_token (id_user, id_media_file, token, `date`)'.
				' VALUES ('. $id_user .', '. $id_media_file .', "'. md5(uniqid(rand(), true)) .'", NOW())'
			);
			$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_user, id_media_file, id_workflow, type, `comment`, tc_in, tc_out)' .
				' VALUES ('. $id_user . ', ' . $id_media_file . ', '. $wf .', "'. $mode .'", "'.$comment.'", '.$tc_in.', '.$tc_out.');'
			);
		}
		else {
			$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_user, id_media_file, id_workflow, type, `comment`, tc_in, tc_out)' .
				' VALUES ('. $id_user . ', ' . $id_media_file . ', '. $wf .', "'. $mode .'", "'.$comment.'", '.$tc_in.', '.$tc_out.');'
			);
		}

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewCart: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewCartWithChapter($data) {
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);
		$id_media_file = $this->_mysqli->real_escape_string($data['id_media_file_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_user, id_media_file)' .
			' VALUES ('. $id_user . ', ' . $id_media_file . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewCartWithChapter: ' . $this->_mysqli->error : '',
		);
	}

	public function updateCartWithId($data, $cart_id) {
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);
		$cart_id = $this->_mysqli->real_escape_string($cart_id);

		$data = $this->_mysqli->query('UPDATE ' . $this->_table .
			' SET id_user = ' . $id_user . ', id_media = ' . $id_media .
			' WHERE id = ' . $cart_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'updateCartWithId: ' . $this->_mysqli->error : '',
		);
	}

	public function findCartById($cart_id) {
		$cart_id = $this->_mysqli->real_escape_string($cart_id);

		$data = $this->_mysqli->query('SELECT id, id_user, id_media' .
									' FROM ' . $this->_table .
									' WHERE id = ' . $cart_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findCartById: ' . $this->_mysqli->error : '',
		);
	}

	public function deleteCartById($cart_id) {
		$cart_id = $this->_mysqli->real_escape_string($cart_id);

		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table .
			' WHERE id = ' . $cart_id . ';'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'deleteCartById: ' . $this->_mysqli->error : '',
		);
	}

	public function emptyCart() {
		$data = $this->_mysqli->query('DELETE FROM ' . $this->_table . ' WHERE id_user = ' . $_SESSION['user_id_mediastorage']);
		
		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'emptyCart: ' . $this->_mysqli->error : '',
		);
	}
}