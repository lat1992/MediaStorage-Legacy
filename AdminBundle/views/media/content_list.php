<?php

require_once('ClientBundle/views/layout/header.php');

?>

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

		<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
<?php
		if(isset($_SESSION['permits'][PERMIT_CREATE_CONTENT])) {
?>
			<div class="add">
				<a href="?page=create_content_admin"><?= CREATE_MEDIA_CONTENT ?></a>
			</div>
<?php
		}

		require_once('RootBundle/views/common/table_list.php');

?>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
