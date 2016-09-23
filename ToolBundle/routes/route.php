<?php

	if (isset($_SESSION['permits'][PERMIT_ROOT])) {
		$this->_route[] = array('initdb', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'initDB');
	}

	$this->_route[] = array('use_workflow_api', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'useWorkFlow');

?>