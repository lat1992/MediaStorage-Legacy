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

$this->_route[] = array('dashboard', 'ClientBundle/controllers/FolderPageController.php', 'FolderPageController', 'FolderPageAction');

$this->_route[] = array('search', 'ClientBundle/controllers/SearchPageController.php', 'SearchPageController', 'SearchPageAction');

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

// LANGUAGE

$this->_route[] = array('create_language', 'CoreBundle/controllers/LanguageController.php', 'LanguageController', 'createAction');
$this->_route[] = array('edit_language', 'CoreBundle/controllers/LanguageController.php', 'LanguageController', 'editAction');
$this->_route[] = array('delete_language', 'CoreBundle/controllers/LanguageController.php', 'LanguageController', 'deleteAction');

// GROUP

$this->_route[] = array('create_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'createAction');
$this->_route[] = array('edit_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'editAction');
$this->_route[] = array('delete_group', 'CoreBundle/controllers/GroupController.php', 'GroupController', 'deleteAction');


$this->_route[] = array('create_group_language', 'CoreBundle/controllers/GroupLanguageController.php', 'GroupLanguageController', 'createAction');
$this->_route[] = array('edit_group_language', 'CoreBundle/controllers/GroupLanguageController.php', 'GroupLanguageController', 'editAction');
$this->_route[] = array('delete_group_language', 'CoreBundle/controllers/GroupLanguageController.php', 'GroupLanguageController', 'deleteAction');

// MEDIA

$this->_route[] = array('create_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'createAction');
$this->_route[] = array('edit_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'editAction');
$this->_route[] = array('delete_media', 'CoreBundle/controllers/MediaController.php', 'MediaController', 'deleteAction');

$this->_route[] = array('create_media_info', 'CoreBundle/controllers/MediaInfoController.php', 'MediaInfoController', 'createAction');
$this->_route[] = array('edit_media_info', 'CoreBundle/controllers/MediaInfoController.php', 'MediaInfoController', 'editAction');
$this->_route[] = array('delete_media_info', 'CoreBundle/controllers/MediaInfoController.php', 'MediaInfoController', 'deleteAction');

$this->_route[] = array('create_media_info_extra_field', 'CoreBundle/controllers/MediaInfoExtraFieldController.php', 'MediaInfoExtraFieldController', 'createAction');
$this->_route[] = array('edit_media_info_extra_field', 'CoreBundle/controllers/MediaInfoExtraFieldController.php', 'MediaInfoExtraFieldController', 'editAction');
$this->_route[] = array('delete_media_info_extra_field', 'CoreBundle/controllers/MediaInfoExtraFieldController.php', 'MediaInfoExtraFieldController', 'deleteAction');

$this->_route[] = array('create_media_info_extra_array', 'CoreBundle/controllers/MediaInfoExtraArrayController.php', 'MediaInfoExtraArrayController', 'createAction');
$this->_route[] = array('edit_media_info_extra_array', 'CoreBundle/controllers/MediaInfoExtraArrayController.php', 'MediaInfoExtraArrayController', 'editAction');
$this->_route[] = array('delete_media_info_extra_array', 'CoreBundle/controllers/MediaInfoExtraArrayController.php', 'MediaInfoExtraArrayController', 'deleteAction');

$this->_route[] = array('create_media_info_extra', 'CoreBundle/controllers/MediaInfoExtraController.php', 'MediaInfoExtraController', 'createAction');
$this->_route[] = array('edit_media_info_extra', 'CoreBundle/controllers/MediaInfoExtraController.php', 'MediaInfoExtraController', 'editAction');
$this->_route[] = array('delete_media_info_extra', 'CoreBundle/controllers/MediaInfoExtraController.php', 'MediaInfoExtraController', 'deleteAction');

$this->_route[] = array('create_media_type', 'CoreBundle/controllers/MediaTypeController.php', 'MediaTypeController', 'createAction');
$this->_route[] = array('edit_media_type', 'CoreBundle/controllers/MediaTypeController.php', 'MediaTypeController', 'editAction');
$this->_route[] = array('delete_media_type', 'CoreBundle/controllers/MediaTypeController.php', 'MediaTypeController', 'deleteAction');

$this->_route[] = array('create_media_type_field', 'CoreBundle/controllers/MediaTypeFieldController.php', 'MediaTypeFieldController', 'createAction');
$this->_route[] = array('edit_media_type_field', 'CoreBundle/controllers/MediaTypeFieldController.php', 'MediaTypeFieldController', 'editAction');
$this->_route[] = array('delete_media_type_field', 'CoreBundle/controllers/MediaTypeFieldController.php', 'MediaTypeFieldController', 'deleteAction');

// TAG

$this->_route[] = array('create_tag', 'CoreBundle/controllers/TagController.php', 'TagController', 'createAction');
$this->_route[] = array('edit_tag', 'CoreBundle/controllers/TagController.php', 'TagController', 'editAction');
$this->_route[] = array('delete_tag', 'CoreBundle/controllers/TagController.php', 'TagController', 'deleteAction');

$this->_route[] = array('create_tag_language', 'CoreBundle/controllers/TagLanguageController.php', 'TagLanguageController', 'createAction');
$this->_route[] = array('edit_tag_language', 'CoreBundle/controllers/TagLanguageController.php', 'TagLanguageController', 'editAction');
$this->_route[] = array('delete_tag_language', 'CoreBundle/controllers/TagLanguageController.php', 'TagLanguageController', 'deleteAction');

// Cart

$this->_route[] = array('create_cart', 'CoreBundle/controllers/CartController.php', 'CartController', 'createAction');
$this->_route[] = array('edit_cart', 'CoreBundle/controllers/CartController.php', 'CartController', 'editAction');
$this->_route[] = array('delete_cart', 'CoreBundle/controllers/CartController.php', 'CartController', 'deleteAction');

// Chapter

$this->_route[] = array('create_chapter', 'CoreBundle/controllers/ChapterController.php', 'ChapterController', 'createAction');
$this->_route[] = array('edit_chapter', 'CoreBundle/controllers/ChapterController.php', 'ChapterController', 'editAction');
$this->_route[] = array('delete_chapter', 'CoreBundle/controllers/ChapterController.php', 'ChapterController', 'deleteAction');

$this->_route[] = array('create_chapter_language', 'CoreBundle/controllers/ChapterLanguageController.php', 'ChapterLanguageController', 'createAction');
$this->_route[] = array('edit_chapter_language', 'CoreBundle/controllers/ChapterLanguageController.php', 'ChapterLanguageController', 'editAction');
$this->_route[] = array('delete_chapter_language', 'CoreBundle/controllers/ChapterLanguageController.php', 'ChapterLanguageController', 'deleteAction');

// Maillist

$this->_route[] = array('create_maillist', 'CoreBundle/controllers/MaillistController.php', 'MaillistController', 'createAction');
$this->_route[] = array('edit_maillist', 'CoreBundle/controllers/MaillistController.php', 'MaillistController', 'editAction');
$this->_route[] = array('delete_maillist', 'CoreBundle/controllers/MaillistController.php', 'MaillistController', 'deleteAction');

// Folder

$this->_route[] = array('create_folder', 'CoreBundle/controllers/FolderController.php', 'FolderController', 'createAction');
$this->_route[] = array('edit_folder', 'CoreBundle/controllers/FolderController.php', 'FolderController', 'editAction');
$this->_route[] = array('delete_folder', 'CoreBundle/controllers/FolderController.php', 'FolderController', 'deleteAction');

$this->_route[] = array('create_folder_language', 'CoreBundle/controllers/FolderLanguageController.php', 'FolderLanguageController', 'createAction');
$this->_route[] = array('edit_folder_language', 'CoreBundle/controllers/FolderLanguageController.php', 'FolderLanguageController', 'editAction');
$this->_route[] = array('delete_folder_language', 'CoreBundle/controllers/FolderLanguageController.php', 'FolderLanguageController', 'deleteAction');

$this->_route[] = array('create_folder_media', 'CoreBundle/controllers/FolderMediaController.php', 'FolderMediaController', 'createAction');
$this->_route[] = array('edit_folder_media', 'CoreBundle/controllers/FolderMediaController.php', 'FolderMediaController', 'editAction');
$this->_route[] = array('delete_folder_media', 'CoreBundle/controllers/FolderMediaController.php', 'FolderMediaController', 'deleteAction');