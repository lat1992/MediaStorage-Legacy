<?php

require_once('CoreBundle/managers/MediaFileManager.php');
require_once('AdminBundle/ressources/fine-uploader-server/handler.php');

class MediaFileController {

	private $_mediaFileManager;
	private $_uploadHandler;

	private $_errorArray;

	public function __construct() {
		$this->_mediaFileManager = new MediaFileManager();
		$this->_uploadHandler = new UploadHandler();

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

	public function createAction() {

		$title = MEDIA_FILE_UPLOAD_TITLE;

		$media_files = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();
		$this->mergeErrorArray($media_files);

		include ('AdminBundle/views/media_file/media_file_create.php');
	}

    public function uploadAction() {

        $mainPath = 'uploads/files/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/';
        $chunkpath = 'uploads/chunks/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/';

		if (!file_exists('uploads/files/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/')) {
		    mkdir('uploads/files/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/', 0777, true);
		}
		if (!file_exists('uploads/chunks/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/')) {
		    mkdir('uploads/chunks/' . $_SESSION['id_organization'] . '/' . $_SESSION['user_id_mediastorage'] . '/', 0777, true);
		}

        $this->_uploadHandler->allowedExtensions = array();
        $this->_uploadHandler->inputName = "qqfile";
        $this->_uploadHandler->chunksFolder = $chunkpath;

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "POST") {

            header("Content-Type: text/plain");

            if (isset($_GET["done"])) {
                $result = $this->_uploadHandler->combineChunks($mainPath);
            }

            else {
                $result = $this->_uploadHandler->handleUpload($mainPath);

                // To return a name used for uploaded file you can use the following line.
                $result["uploadName"] = $this->_uploadHandler->getUploadName();

                $this->_mediaFileManager->formatPostDataFromFileUpload($result);

                $return_value = $this->_mediaFileManager->createMediaFileDb();

                $this->mergeErrorArray($return_value);

                if (count($this->_errorArray) != 0) {
                	$result['error'] = $this->_errorArray[0];
                }
            }

            echo json_encode($result);
        }

        // for delete file requests
        else if ($method == "DELETE") {
            $result = $this->_uploadHandler->handleDelete("files");
            echo json_encode($result);
        }

        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }
    }

    public function ajaxRefreshUploadListAction() {

		$media_files_data = $this->_mediaFileManager->getAllMediaFilesWithoutMediaIdDb();
		$this->mergeErrorArray($media_files_data);

		if (count($this->_errorArray) == 0) {

			$media_file = array();

			while ($media_file_data_temp = $media_files_data['data']->fetch_assoc()) {
				$media_file[] = $media_file_data_temp;
			}

			if ($media_file)
				echo json_encode($media_file);
		}

		echo '';
		return;

    }
}