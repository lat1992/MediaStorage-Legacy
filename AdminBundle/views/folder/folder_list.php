<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

	<div id="container">

		<div class="add">
			<a href="?page=create_folder_admin"><?= FOLDER_CREATION_TITLE ?></a>
		</div>

<?php

		require_once('RootBundle/views/common/table_list.php');

?>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>