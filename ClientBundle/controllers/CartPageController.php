<?php

require_once('CoreBundle/managers/CartManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');

class CartPageController {

	private $_cartManager;
	private $_toolboxManager;
	private $_designManager;

	private $_errorArray;

	public function __construct() {
		$this->_cartManager = new CartManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();

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

		if (isset($_SESSION['id_plateform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_plateform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title = CART;

		include ('ClientBundle/views/cart/cart.php');
	}

	public function createCartAction() {
		$_POST['id_user_mediastorage'] = $_SESSION['user_id_mediastorage'];
		$_POST['id_media_mediastorage'] = $_GET['media_id'];

		$cart_data = $this->_cartManager->cartCreateDb();

		$this->mergeErrorArray($cart_data);

		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . '?page=content&media_id=' . $_GET['original_id']);
			exit;
		}

		include ('CoreBundle/views/common/error.php');
	}

	public function deleteCartAction() {

		$cart_data = $this->_cartManager->removeCartByIdDb($_GET['cart_id']);

		$this->mergeErrorArray($cart_data);

		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . '?page=cart');
			exit;
		}

		include ('ClientBundle/views/cart/cart.php');
	}
}