<?php

$this->_route[] = array('home', 'ClientBundle/controllers/HomePageController.php', 'HomePageController', 'homeAction');

$this->_route[] = array('folder', 'ClientBundle/controllers/FolderPageController.php', 'FolderPageController', 'folderPageAction');

$this->_route[] = array('content', 'ClientBundle/controllers/ContentPageController.php', 'ContentPageController', 'contentPageAction');

$this->_route[] = array('profile', 'ClientBundle/controllers/ProfilePageController.php', 'ProfilePageController', 'profileAction');

$this->_route[] = array('search', 'ClientBundle/controllers/SearchPageController.php', 'SearchPageController', 'searchPageAction');

?>