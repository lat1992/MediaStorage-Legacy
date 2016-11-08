<?php

$this->_route[] = array('dashboard_admin', 'AdminBundle/controllers/DashboardController.php', 'DashboardController', 'showAction');

$this->_route[] = array('create_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'createAction');
$this->_route[] = array('list_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'listAction');
$this->_route[] = array('edit_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'editAction');
// $this->_route[] = array('delete_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'deleteAction');
$this->_route[] = array('ajax_get_folder_by_parent_id_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'ajaxGetFolderByParentIdAction');
$this->_route[] = array('upload_thumbnail_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'uploadThumbnailAction');


$this->_route[] = array('create_program_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'createProgramAction');
$this->_route[] = array('edit_program_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'editProgramAction');
$this->_route[] = array('list_program_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'listProgramAction');
$this->_route[] = array('upload_program_thumbnail_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'uploadProgramThumbnailAction');

$this->_route[] = array('create_content_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'createContentAction');
$this->_route[] = array('create_content_by_multiple_files_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'createContentByMultipleFilesAction');
$this->_route[] = array('edit_content_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'editContentAction');
$this->_route[] = array('list_content_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'listContentAction');
$this->_route[] = array('upload_content_thumbnail_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'uploadContentThumbnailAction');


$this->_route[] = array('create_media_file_admin', 'AdminBundle/controllers/MediaFileController.php', 'MediaFileController', 'createAction');
$this->_route[] = array('upload_media_file_admin', 'AdminBundle/controllers/MediaFileController.php', 'MediaFileController', 'uploadAction');
$this->_route[] = array('ajax_refresh_upload_list', 'AdminBundle/controllers/MediaFileController.php', 'MediaFileController', 'ajaxRefreshUploadListAction');
$this->_route[] = array('delete_media_file_admin', 'AdminBundle/controllers/MediaFileController.php', 'MediaFileController', 'deleteAction');

$this->_route[] = array('list_users_admin', 'AdminBundle/controllers/UserController.php', 'UserController', 'listAction');
$this->_route[] = array('create_user_admin', 'AdminBundle/controllers/UserController.php', 'UserController', 'createAction');
$this->_route[] = array('edit_user_admin', 'AdminBundle/controllers/UserController.php', 'UserController', 'editAction');
$this->_route[] = array('delete_user_admin', 'AdminBundle/controllers/UserController.php', 'UserController', 'deleteAction');

?>