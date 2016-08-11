<?php

require_once('CoreBundle/managers/MailManager.php');
require_once('CoreBundle/managers/OrganizationManager.php');

class MailController {

	private $_mailManager;
	private $_organizationManager;

	private $_errorArray;

	public function __construct() {
		$this->_mailManager = new MailManager();
		$this->_organizationManager = new OrganizationManager();

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

	public function listAction() {
		$mails = $this->_mailManager->getAllMailsDb();

		$this->mergeErrorArray($mails);

		$table_header = array(
				'<th>' . ID . '</th>',
				'<th>' . ORGANIZATION . '</th>',
				'<th>' . EMAIL . '</th>',
				'<th></th>',
				'<th></th>',
			);

		$table_data[] = array();

		if (count($this->_errorArray) == 0) {

			while ($mail = $mails['data']->fetch_assoc()) {
				$table_data[] = array(
					'<td>' . $mail['id'] . '</td>',
					'<td>' . $mail['organization_name'] . '</td>',
					'<td>' . $mail['email'] . '</td>',
					'<td class="button_td edit" ><a href="?page=edit_mail_root&mail_id=' . $mail['id'] . '" class="button_a edit">' . EDIT . '</a></td>',
					'<td class="button_td delete" ><a href="?page=delete_mail_root&mail_id=' . $mail['id'] . '" class="button_a delete">' . DELETE . '</a></td>',
				);
			}

		}

		$title = MAIL_LIST_TITLE;

		include ('RootBundle/views/mail/mail_list.php');
	}

	public function createAction() {
		$mail = array();

		if (isset($_POST['id_mail_create_mediastorage']) && (strcmp($_POST['id_mail_create_mediastorage'], '754351') == 0)) {
			$mail = $this->_mailManager->formatMailArrayWithPostData();
			$return_value['error'] = $this->_mailManager->mailCreateFormCheck();
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {

				$return_value = $this->_mailManager->mailCreateDb();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {
					$_SESSION['flash_message'] = ACTION_SUCCESS;
					header('Location:' . '?page=list_mail_root');
					exit;
				}
			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = MAIL_CREATION_TITLE;

		include ('RootBundle/views/mail/mail_create.php');
	}

	public function editAction() {
		$mail_data = $this->_mailManager->getMailByIdDb($_GET['mail_id']);

		$this->mergeErrorArray($mail_data);

		if (count($this->_errorArray) == 0) {

			while ($mail_data_temp = $mail_data['data']->fetch_assoc()) {
				$mail = $mail_data_temp;
			}

			if (isset($_POST['id_mail_create_mediastorage']) && (strcmp($_POST['id_mail_create_mediastorage'], '754351') == 0)) {
				$return_value['error'] = $this->_mailManager->mailCreateFormCheck();
				$this->mergeErrorArray($return_value);

				if (count($this->_errorArray) == 0) {

					$return_value = $this->_mailManager->mailEditDb($mail);
					$this->mergeErrorArray($return_value);

					if (count($this->_errorArray) == 0) {
						$_SESSION['flash_message'] = ACTION_SUCCESS;
						header('Location:' . '?page=list_mail_root');
						exit;
					}
				}

			}
		}

		$organizations = $this->_organizationManager->getAllOrganizationsDb();

		$this->mergeErrorArray($organizations);

		$title = MAIL_EDIT_TITLE;
		include ('RootBundle/views/mail/mail_create.php');
	}

	public function deleteAction() {
		if (isset($_GET['mail_id'])) {

			$return_value = $this->_mailManager->removeMailByIdDb($_GET['mail_id']);
			$this->mergeErrorArray($return_value);

			if (count($this->_errorArray) == 0) {
				header('Location:' . '?page=list_mail_root');
			}
		}

		include ('CoreBundle/views/common/error.php');
	}
}