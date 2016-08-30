<?php

require_once('CoreBundle/managers/CartManager.php');

class CartPageController {

	private $_cartManager;

	private $_errorArray;

	public function __construct() {
		$this->_cartManager = new CartManager();

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

	public function cartPageAction() {

		$cart_data = $this->_cartManager->getAllCartsByUserIdDb();

		$this->mergeErrorArray($cart_data);

		$title = CART;

		include ('ClientBundle/views/cart/cart.php');
	}
}