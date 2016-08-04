<?php

require_once('Model.php');

class Cart extends Model {

	public function __construct() {
		parent::__construct('cart');
	}

	public function findAllCarts() {
		$data = $this->_mysqli->query('SELECT id, id_user, id_media ' .
			' FROM ' . $this->_table
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'findAllCarts: ' . $this->_mysqli->error : '',
		);
	}

	public function createNewCart($data) {
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

		$data = $this->_mysqli->query('INSERT INTO ' . $this->_table . '(id_user, id_media)' .
			' VALUES ('. $id_user . ', ' . $id_media . ');'
		);

		return array(
			'data' => $data,
			'error' => ($this->_mysqli->error) ? 'createNewCart: ' . $this->_mysqli->error : '',
		);
	}

	public function updateCartWithId($data, $cart_id) {
		$id_user = $this->_mysqli->real_escape_string($data['id_user_mediastorage']);
		$id_media = $this->_mysqli->real_escape_string($data['id_media_mediastorage']);

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
}