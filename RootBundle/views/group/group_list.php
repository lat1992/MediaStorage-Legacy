<?php

require_once('RootBundle/views/layout/header.php');

?>

<!-- <link rel="stylesheet" href="RootBundle/ressources/folder/css/folder.css">

<script src="RootBundle/ressources/folder/js/folder.js"></script> -->

<div id="container">

	<div class="add">
		<a href="?page=create_group_root"><?= GROUP_CREATION_TITLE ?></a>
	</div>

<?php

	require_once('RootBundle/views/common/table_list.php');

?>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
