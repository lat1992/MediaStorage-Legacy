<?php

// LOGIN

$this->_route[] = array('login', 'CoreBundle/controllers/UserController.php', 'UserController', 'loginAction');

// LOGOUT

$this->_route[] = array('logout', 'CoreBundle/controllers/UserController.php', 'UserController', 'logoutAction');

// MANAGE USER

$this->_route[] = array('create_user', 'CoreBundle/controllers/UserController.php', 'UserController', 'createAction');
$this->_route[] = array('list_user', 'CoreBundle/controllers/UserController.php', 'UserController', 'listAction');
$this->_route[] = array('edit_user', 'CoreBundle/controllers/UserController.php', 'UserController', 'editAction');
$this->_route[] = array('delete_user', 'CoreBundle/controllers/UserController.php', 'UserController', 'deleteAction');

// TEST

$this->_route[] = array('dashboard', 'CoreBundle/controllers/UserController.php', 'UserController', 'dashboardAction');

// MANAGE ROLE

$this->_route[] = array('list_role', 'CoreBundle/controllers/RoleController.php', 'RoleController', 'listAction');
$this->_route[] = array('create_role', 'CoreBundle/controllers/RoleController.php', 'RoleController', 'createAction');
$this->_route[] = array('edit_role', 'CoreBundle/controllers/RoleController.php', 'RoleController', 'editAction');
$this->_route[] = array('delete_role', 'CoreBundle/controllers/RoleController.php', 'RoleController', 'deleteAction');
$this->_route[] = array('create_role_language', 'CoreBundle/controllers/RoleLanguageController.php', 'RoleLanguageController', 'createAction');
$this->_route[] = array('edit_role_language', 'CoreBundle/controllers/RoleLanguageController.php', 'RoleLanguageController', 'editAction');
$this->_route[] = array('delete_role_language', 'CoreBundle/controllers/RoleLanguageController.php', 'RoleLanguageController', 'deleteAction');