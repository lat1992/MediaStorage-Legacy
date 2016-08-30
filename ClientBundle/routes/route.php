<?php

$this->_route[] = array('home', 'ClientBundle/controllers/HomePageController.php', 'HomePageController', 'showAction');

$this->_route[] = array('folder', 'ClientBundle/controllers/FolderPageController.php', 'FolderPageController', 'folderPageAction');

$this->_route[] = array('program', 'ClientBundle/controllers/ProgramPageController.php', 'ProgramPageController', 'programPageAction');

$this->_route[] = array('content', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'contentPageAction');
$this->_route[] = array('list_content', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'listContentAction');

$this->_route[] = array('profile', 'ClientBundle/controllers/ProfilePageController.php', 'ProfilePageController', 'profileAction');

$this->_route[] = array('search', 'ClientBundle/controllers/SearchPageController.php', 'SearchPageController', 'searchPageAction');

$this->_route[] = array('cart', 'ClientBundle/controllers/CartPageController.php', 'CartPageController', 'cartPageAction');

?>