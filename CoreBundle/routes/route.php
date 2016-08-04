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

$this->_route[] = array('create_role_permit', 'CoreBundle/controllers/RolePermitController.php', 'RolePermitController', 'createAction');
$this->_route[] = array('edit_role_permit', 'CoreBundle/controllers/RolePermitController.php', 'RolePermitController', 'editAction');
$this->_route[] = array('delete_role_permit', 'CoreBundle/controllers/RolePermitController.php', 'RolePermitController', 'deleteAction');

// SHARELIST

$this->_route[] = array('create_sharelist', 'CoreBundle/controllers/SharelistController.php', 'SharelistController', 'createAction');
$this->_route[] = array('edit_sharelist', 'CoreBundle/controllers/SharelistController.php', 'SharelistController', 'editAction');
$this->_route[] = array('delete_sharelist', 'CoreBundle/controllers/SharelistController.php', 'SharelistController', 'deleteAction');


$this->_route[] = array('create_sharelist_media', 'CoreBundle/controllers/SharelistMediaController.php', 'SharelistMediaController', 'createAction');
$this->_route[] = array('edit_sharelist_media', 'CoreBundle/controllers/SharelistMediaController.php', 'SharelistMediaController', 'editAction');
$this->_route[] = array('delete_sharelist_media', 'CoreBundle/controllers/SharelistMediaController.php', 'SharelistMediaController', 'deleteAction');

// ORGANIZATION

$this->_route[] = array('create_organization', 'CoreBundle/controllers/OrganizationController.php', 'OrganizationController', 'createAction');
$this->_route[] = array('edit_organization', 'CoreBundle/controllers/OrganizationController.php', 'OrganizationController', 'editAction');
$this->_route[] = array('delete_organization', 'CoreBundle/controllers/OrganizationController.php', 'OrganizationController', 'deleteAction');

// GROUP

$this->_route[] = array('create_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'createAction');
$this->_route[] = array('edit_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'editAction');
$this->_route[] = array('delete_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'deleteAction');

// MEDIA

$this->_route[] = array('list_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'listAction');
$this->_route[] = array('create_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'createAction');
$this->_route[] = array('edit_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'editAction');
$this->_route[] = array('delete_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'deleteAction');