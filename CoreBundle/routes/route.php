<?php

// LOGIN

$this->_route[] = array('login', 'CoreBundle/controllers/UserController.php', 'UserController', 'loginAction');
$this->_route[] = array('forgot_password', 'CoreBundle/controllers/UserController.php', 'UserController', 'forgotPasswordAction');

// LOGOUT

$this->_route[] = array('logout', 'CoreBundle/controllers/UserController.php', 'UserController', 'logoutAction');
