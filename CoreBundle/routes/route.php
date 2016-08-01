<?php

// LOGIN

$this->_route[] = array('login', 'CoreBundle/controllers/UserController.php', 'UserController', 'loginAction');

// LOGOUT

$this->_route[] = array('logout', 'CoreBundle/controllers/UserController.php', 'UserController', 'logoutAction');

// CREATION USER

$this->_route[] = array('create', 'CoreBundle/controllers/UserController.php', 'UserController', 'createAction');

// TEST

$this->_route[] = array('dashboard', 'CoreBundle/controllers/UserController.php', 'UserController', 'dashboardAction');