<?php

$this->_route[] = array('create_user', 'RootBundle/controllers/UserController.php', 'UserController', 'createAction');
$this->_route[] = array('list_user', 'RootBundle/controllers/UserController.php', 'UserController', 'listAction');
$this->_route[] = array('edit_user', 'RootBundle/controllers/UserController.php', 'UserController', 'editAction');
$this->_route[] = array('delete_user', 'RootBundle/controllers/UserController.php', 'UserController', 'deleteAction');

?>