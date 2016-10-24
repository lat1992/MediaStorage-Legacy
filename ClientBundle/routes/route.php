<?php

$this->_route[] = array('home', 'ClientBundle/controllers/HomePageController.php', 'HomePageController', 'showAction');

$this->_route[] = array('folder', 'ClientBundle/controllers/FolderPageController.php', 'FolderPageController', 'folderPageAction');

$this->_route[] = array('program', 'ClientBundle/controllers/ProgramPageController.php', 'ProgramPageController', 'programPageAction');

$this->_route[] = array('content', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'contentPageAction');
$this->_route[] = array('list_content', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'listContentAction');
$this->_route[] = array('delete_chapter', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'deleteChapterAction');


$this->_route[] = array('profile', 'ClientBundle/controllers/ProfilePageController.php', 'ProfilePageController', 'profileAction');

$this->_route[] = array('search', 'ClientBundle/controllers/SearchPageController.php', 'SearchPageController', 'searchPageAction');
$this->_route[] = array('ajax_refresh_live_search', 'ClientBundle/controllers/SearchPageController.php', 'SearchPageController', 'ajaxRefreshLiveSearchAction');

$this->_route[] = array('cart', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'cartPageAction');
$this->_route[] = array('add_cart', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'createCartAction');
$this->_route[] = array('delete_cart', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'deleteCartAction');
$this->_route[] = array('validate_cart', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'validateCartAction');
$this->_route[] = array('general_condition', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'generalConditionPageAction');

$this->_route[] = array('sharelist', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'sharelistPageAction');
$this->_route[] = array('create_sharelist', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'createSharelistAction');
$this->_route[] = array('sharelist_edit', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'editSharelistAction');
$this->_route[] = array('delete_sharelist', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'deleteSharelistAction');
$this->_route[] = array('delete_sharelist_media', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'deleteSharelistMediaAction');
$this->_route[] = array('add_sharelist_media', 'ClientBundle/controllers/SharelistPageController.php', 'SharelistPageController', 'createSharelistMediaAction');

?>