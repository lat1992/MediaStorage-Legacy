<?php

	if (isset($_SESSION['permits'][PERMIT_ROOT])) {
		$this->_route[] = array('initdb', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'initDB');
	}

	$this->_route[] = array('use_workflow_api', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'useWorkFlow');
	$this->_route[] = array('post_production_workflow_api', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'postProductionWorkFlow');
	$this->_route[] = array('end_production_workflow_api', 'ToolBundle/controllers/ToolController.php', 'ToolController', 'endProductionWorkFlow');
?>