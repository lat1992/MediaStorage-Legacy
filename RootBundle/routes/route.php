<?php

$this->_route[] = array('create_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'createAction');
$this->_route[] = array('list_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'listAction');
$this->_route[] = array('edit_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'editAction');
$this->_route[] = array('delete_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'deleteAction');

$this->_route[] = array('create_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'createAction');
$this->_route[] = array('list_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'listAction');
$this->_route[] = array('edit_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'editAction');
$this->_route[] = array('delete_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'deleteAction');

?>