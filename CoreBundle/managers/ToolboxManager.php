<?php

class ToolBoxManager {

	public function mysqliResultToArray($mysqli_data) {

		$array_data = array();

		if ($mysqli_data && $mysqli_data['data']) {

			while ($mysqli_result = $mysqli_data['data']->fetch_assoc()) {
				$array_data[] = $mysqli_result;
			}

		}

		return $array_data;
	}

	public function mysqliResultToData($mysqli_data) {

		$data = array();

		if ($mysqli_data && $mysqli_data['data']) {

			while ($mysqli_result = $mysqli_data['data']->fetch_assoc()) {
				$data = $mysqli_result;
			}

		}

		return $data;
	}

	public function setLastPageInSession() {
		$_SESSION['last_url'] = $_SERVER['REQUEST_URI'];
	}

	public function redirectOnLastPageInSession() {
		if (isset($_SESSION['last_url'])) {
			$url = $_SESSION['last_url'];
			$_SESSION['flash_message'] = ACTION_SUCCESS;
			header('Location:' . $url);
			exit;
		}
	}

	public function getCancelUrl(&$cancel_url, $default_url) {
		if (isset($_SESSION['last_url'])) {
			$cancel_url = $_SESSION['last_url'];
		}
		else {
			$cancel_url = $default_url;
		}
	}

}