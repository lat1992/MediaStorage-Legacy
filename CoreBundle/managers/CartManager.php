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
		return $this->_cartModel->findAllCartsByUserId($_SESSION['user_id_mediastorage'], $_SESSION['id_language_mediastorage']);
	}

	public function getAllDeliveryDB() {
		return $this->_cartModel->findAllDeliveryByUserId($_SESSION['user_id_mediastorage']);
	}

	public function getAllCutDB() {
		return $this->_cartModel->findAllCutByUserId($_SESSION['user_id_mediastorage']);
	}

	public function getAllDownloadDB() {
		return $this->_cartModel->findAllDownloadByUserId($_SESSION['user_id_mediastorage']);
	}

	public function getAllTranscode() {
		return $this->_cartModel->findAllTranscodeByUserId($_SESSION['user_id_mediastorage']);
	}

	public function getAllDownloadHistoryDB() {
		return $this->_cartModel->findAllDownloadHistoryByUserId($_SESSION['user_id_mediastorage']);
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

	public function cartCreateDb($id_user, $id_media_file, $mode, $wf, $comment) {
		return $this->_cartModel->createNewCart($id_user, $id_media_file, $mode, $wf, $comment);
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

	public function emptyCartDb() {
		return $this->_cartModel->emptyCart();
	}

}