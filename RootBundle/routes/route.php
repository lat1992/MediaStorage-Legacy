<?php

$this->_route[] = array('dashboard_root', 'RootBundle/controllers/DashboardController.php', 'DashboardController', 'showAction');

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

$this->_route[] = array('select_organization_mail_root', 'RootBundle/controllers/MailController.php', 'MailController', 'selectOrganizationAction');
$this->_route[] = array('create_mail_root', 'RootBundle/controllers/MailController.php', 'MailController', 'createAction');
$this->_route[] = array('list_mail_root', 'RootBundle/controllers/MailController.php', 'MailController', 'listAction');
$this->_route[] = array('edit_mail_root', 'RootBundle/controllers/MailController.php', 'MailController', 'editAction');
$this->_route[] = array('delete_mail_root', 'RootBundle/controllers/MailController.php', 'MailController', 'deleteAction');

$this->_route[] = array('create_language_root', 'RootBundle/controllers/LanguageController.php', 'LanguageController', 'createAction');
$this->_route[] = array('list_language_root', 'RootBundle/controllers/LanguageController.php', 'LanguageController', 'listAction');
$this->_route[] = array('edit_language_root', 'RootBundle/controllers/LanguageController.php', 'LanguageController', 'editAction');
$this->_route[] = array('delete_language_root', 'RootBundle/controllers/LanguageController.php', 'LanguageController', 'deleteAction');

$this->_route[] = array('select_organization_media_extra_field_root', 'RootBundle/controllers/MediaExtraFieldController.php', 'MediaExtraFieldController', 'selectOrganizationAction');
$this->_route[] = array('create_media_extra_field_root', 'RootBundle/controllers/MediaExtraFieldController.php', 'MediaExtraFieldController', 'createAction');
$this->_route[] = array('list_media_extra_field_root', 'RootBundle/controllers/MediaExtraFieldController.php', 'MediaExtraFieldController', 'listAction');
$this->_route[] = array('edit_media_extra_field_root', 'RootBundle/controllers/MediaExtraFieldController.php', 'MediaExtraFieldController', 'editAction');
$this->_route[] = array('delete_media_extra_field_root', 'RootBundle/controllers/MediaExtraFieldController.php', 'MediaExtraFieldController', 'deleteAction');
?>