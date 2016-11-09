<?php

require_once('CoreBundle/managers/CartManager.php');
require_once('CoreBundle/managers/ToolboxManager.php');
require_once('CoreBundle/managers/DesignManager.php');
require_once('CoreBundle/managers/UserManager.php');
require_once('CoreBundle/managers/MediaFileManager.php');
require_once('ToolBundle/managers/WorkFlowManager.php');
require_once('CoreBundle/managers/OrganizationTextManager.php');

class CartPageController {

	private $_cartManager;
	private $_toolboxManager;
	private $_designManager;
	private $_mediaFileManager;
	private $_workFlowManager;
	private $_userManager;
	private $_organizationTextManager;

	private $_errorArray;

	public function __construct() {
		$this->_cartManager = new CartManager();
		$this->_toolboxManager = new ToolboxManager();
		$this->_designManager = new DesignManager();
		$this->_mediaFileManager = new MediaFileManager();
		$this->_workFlowManager = new WorkFlowManager();
		$this->_userManager = new UserManager();
		$this->_organizationTextManager = new OrganizationTextManager();

		$settings = parse_ini_file('config.ini.php', true);
		$this->_mail_addr_server = $settings['mail']['server'];
		$this->_mail_addr_regie = $settings['mail']['regie'];
		$this->_mail_addr_it = $settings['mail']['it-service'];
		$this->_mail_addr_other = $settings['mail']['other'];

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

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title['title'] = CART;

		include ('ClientBundle/views/cart/cart.php');
	}

	public function generalConditionPageAction() {

		$general_condition_data = $this->_organizationTextManager->getOrganizationTextWithId($_SESSION['id_platform_organization'], $_SESSION['id_language_mediastorage']);

		$this->mergeErrorArray($general_condition_data);
		$text = $general_condition_data['data']->fetch_assoc();
		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title['title'] = GENERAL_CONDITION_TITLE;

		include ('ClientBundle/views/cart/general_condition.php');
	}

	public function validateCartAction() {
		$cart_transcode = $this->_cartManager->getAllTranscode();
		$this->mergeErrorArray($cart_transcode);
		$cart_delivery = $this->_cartManager->getAllDeliveryDB();
		$this->mergeErrorArray($cart_delivery);
		$cart_cut = $this->_cartManager->getAllCutDB();
		$this->mergeErrorArray($cart_cut);
		$cart_download = $this->_cartManager->getAllDownloadDB();
		$this->mergeErrorArray($cart_download);

		if ($cart_delivery['data']->num_rows)
			$this->mergeErrorArray($this->sendEmailForDelivery($cart_delivery['data'], $_SESSION['user_id_mediastorage']));
		if ($cart_download['data']->num_rows)
			$this->mergeErrorArray($this->showDownloadLink($cart_download['data'], $_SESSION['user_id_mediastorage']));
		if ($cart_cut['data']->num_rows)
			$this->mergeErrorArray($this->_workFlowManager->cutVideo($cart_cut['data']));
		if ($cart_transcode['data']->num_rows)
			$this->mergeErrorArray($this->_workFlowManager->transcodeCart($cart_transcode['data']));

		$cart_data = $this->_cartManager->emptyCartDb();
		$this->mergeErrorArray($cart_data);
		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			exit;
		}
		include ('CoreBundle/views/common/error.php');
	}

	public function createCartAction() {
		$_POST['id_user_mediastorage'] = $_SESSION['user_id_mediastorage'];
		$_POST['id_media_file_mediastorage'] = $_GET['media_file_id'];

		$cart_data = $this->_cartManager->cartCreateDb();

		$this->mergeErrorArray($cart_data);

		if (count($this->_errorArray) == 0) {
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . '?page=content&media_id=' . $_GET['original_id']);
			exit;
		}

		$title['title'] = CART;

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

	private function showDownloadLink($cart_data, $id_user) {
		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}
		$title['title'] = CART;
		include ('ClientBundle/views/cart/cart_download_list.php');
	}

	public function downloadAction() {
		$token = $_GET['token'];
		$data = $this->_mediaFileManager->getMediaFileByToken($token);
		$this->_mediaFileManager->getMediaFileStreamByData($data);
		exit;
	}

	private function sendEmailForDelivery($cart_data, $id_user) {
		$user_data = $this->_userManager->getUserByIdDb($id_user);
		$row = $user_data['data']->fetch_assoc();
		$row_cart = $cart_data->fetch_assoc();
		$to = $this->_mail_addr_regie.','.$this->_mail_addr_it;
		$cc = $this->_mail_addr_other;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: Mediastorage <' . $this->_mail_addr_server . '>'. "\r\n" .
		'Cc: ' . $cc . "\r\n";
		mail($to, MAIL_SUBJECT_DELIVERY, sprintf(MAIL_BODY_DELIVERY, $row['username'], $id_user, $row['email'], $_GET['platform'], $_SESSION['id_platform_organization'], $row_cart['id_media_file']), $headers);
	}

	public function historyAction() {
		$cart_download = $this->_cartManager->getAllDownloadHistoryDB();
		$this->mergeErrorArray($cart_download);
		$cart_data = $cart_download['data'];

		if (isset($_SESSION['id_platform_organization'])) {

			$designs_data = $this->_designManager->getAllDesignWithOrganizationDb($_SESSION['id_platform_organization']);
			$this->mergeErrorArray($designs_data);

			if (count($this->_errorArray) == 0) {
				$designs = $this->_toolboxManager->mysqliResultToArray($designs_data);
			}
		}

		$title['title'] = CART_HISTORY_TITLE;
		include ('ClientBundle/views/cart/cart_history.php');
	}

}