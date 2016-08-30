<?php

require_once('CoreBundle/models/Cart.php');

class CartManager {

	private $_cartModel;

	public function __construct() {
		$this->_cartModel = new Cart();
	}

	public function getAllCartsDb() {
		return $this->_cartModel->findAllCarts();
	}

	public function getAllCartsByUserIdDb() {
		return $this->_cartModel->findAllCartsByUserId($_SESSION['user_id_mediastorage']);
	}

	public function formatCartArrayWithPostData() {
		$cart = array();

		$cart['id_cart'] = $_POST['id_cart_mediastorage'];
		$cart['id_media'] = $_POST['id_media_mediastorage'];

		return $cart;
	}

	public function cartCreateFormCheck() {
		$error_cart = array();

		return $error_cart;
	}

	public function cartCreateDb() {
		return $this->_cartModel->createNewCart($_POST);
	}

	public function getCartByIdDb($cart_id) {
		return $this->_cartModel->findCartById($cart_id);
	}

	public function cartEditDb($cart_data) {
		return $this->_cartModel->updateCartWithId($_POST, $cart_data['id']);
	}

	public function removeCartByIdDb($cart_id) {
		return $this->_cartModel->deleteCartById($cart_id);
	}
}