<?php

require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/CartManager.php');
require_once('CoreBundle/managers/MediaManager.php');

class CartController {

	private $_userManager;
	private $_cartManager;
	private $_mediaManager;

	private $_errorArray;

	public function __construct() {
		$this->_userManager = new UserManager();
		$this->_cartManager = new CartManager();
		$this->_mediaManager = new MediaManager();

		$this->_errorArray = array();
	}

	private function mergeErrorArray($errorArray) {
		if (!empty($errorArray['error'])) {
			if (!is_array($errorArray['error'])) {
				$data_array[] = $errorArray['error'];
			}
			else {
				$data_array = $errorArray['error'];
			}
			$this->_errorArray = array_merge ($this->_errorArray, $data_array);
		}
	}

	// public function listAction() {
	// 	$users = $this->_cartManager->getAllCartsDb();

	// 	$this->mergeErrorArray($carts);

	// 	include ('CoreBundle/views/user/cart_list.php');
	// }

	public function createAction() {
		$cart = array();

		if (isset($_POST['id_cart_create_mediastorage']) && (strcmp($_POST['id_cart_create_mediastorage'], '534748') == 0)) {
			$cart = $this->_cartManager->formatCartArrayWithPostData();
			$return_value['error'] = $this->_cartManager->cartCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				$return_value = $this->_cartManager->cartCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					header('Location:' . '?page=dashboard');
				}
			}
		}

		$users = $this->_userManager->getAllUsersDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($users);
		$this->mergeErrorArray($medias);

		include ('CoreBundle/views/cart/cart_create.php');
	}

	public function editAction() {
		$cart_data = $this->_cartManager->getCartByIdDb($_GET['cart_id']);
		$users = $this->_userManager->getAllUsersDb();
		$medias = $this->_mediaManager->getAllMediasDb();

		$this->mergeErrorArray($cart_data);
		$this->mergeErrorArray($users);
		$this->mergeErrorArray($medias);

		if (count($this->_errorArray) == 0) {

			while ($cart_data_temp = $cart_data['data']->fetch_assoc()) {
				$cart = $cart_data_temp;
			}

			if (isset($_POST['id_cart_create_mediastorage']) && (strcmp($_POST['id_cart_create_mediastorage'], '534748') == 0)) {
				$return_value['error'] = $this->_cartManager->cartCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$return_value = $this->_cartManager->cartEditDb($cart);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						header('Location:' . '?page=dashboard');
					}
				}

			}

		}

		include ('CoreBundle/views/cart/cart_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['cart_id'])) {

			$return_value = $this->_cartManager->removeCartByIdDb($_GET['cart_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=dashboard');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}