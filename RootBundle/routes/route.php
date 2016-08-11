<?php

$this->_route[] = array('create_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'createAction');
$this->_route[] = array('list_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'listAction');
$this->_route[] = array('edit_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'editAction');
$this->_route[] = array('delete_group_root', 'RootBundle/controllers/GroupController.php', 'GroupController', 'deleteAction');

$this->_route[] = array('create_organization_root', 'RootBundle/controllers/OrganizationController.php', 'OrganizationController', 'createAction');
$this->_route[] = array('list_organization_root', 'RootBundle/controllers/OrganizationController.php', 'OrganizationController', 'listAction');
$this->_route[] = array('edit_organization_root', 'RootBundle/controllers/OrganizationController.php', 'OrganizationController', 'editAction');
$this->_route[] = array('delete_organization_root', 'RootBundle/controllers/OrganizationController.php', 'OrganizationController', 'deleteAction');

$this->_route[] = array('create_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'createAction');
$this->_route[] = array('list_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'listAction');
$this->_route[] = array('edit_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'editAction');
$this->_route[] = array('delete_user_root', 'RootBundle/controllers/UserController.php', 'UserController', 'deleteAction');

$this->_route[] = array('create_role_root', 'RootBundle/controllers/RoleController.php', 'RoleController', 'createAction');
$this->_route[] = array('list_role_root', 'RootBundle/controllers/RoleController.php', 'RoleController', 'listAction');
$this->_route[] = array('edit_role_root', 'RootBundle/controllers/RoleController.php', 'RoleController', 'editAction');
$this->_route[] = array('delete_role_root', 'RootBundle/controllers/RoleController.php', 'RoleController', 'deleteAction');
?>