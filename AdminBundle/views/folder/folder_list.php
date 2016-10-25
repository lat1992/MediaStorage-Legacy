<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
	<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

	<style>

<?php
	    if (isset($designs)) {

	        foreach ($designs as $design) {
?>
	            <?= $design['selector'] ?> {
	                <?= $design['property'] ?> : <?= $design['value'] ?>;
	            }
<?php
	        }
	    }
?>
	</style>

	<div id="container">

		<!-- <div class="add"> -->
			<a class="button button-add" href="?page=create_folder_admin"><?= FOLDER_CREATION_TITLE ?></a>
		<!-- </div> -->

<?php

		require_once('RootBundle/views/common/table_list.php');

?>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>