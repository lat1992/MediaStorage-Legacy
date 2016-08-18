<?php

$this->_route[] = array('create_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'createAction');
// $this->_route[] = array('list_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'listAction');
$this->_route[] = array('edit_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'editAction');
// $this->_route[] = array('delete_folder_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'deleteAction');
$this->_route[] = array('ajax_get_folder_by_parent_id_admin', 'AdminBundle/controllers/FolderController.php', 'FolderController', 'ajaxGetFolderByParentIdAction');


$this->_route[] = array('create_program_admin', 'AdminBundle/controllers/MediaController.php', 'MediaController', 'createProgramAction');

?>