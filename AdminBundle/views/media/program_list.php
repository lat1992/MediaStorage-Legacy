<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

	<div id="container">

		<div class="add">
			<a href="?page=create_program_admin"><?= CREATE_MEDIA_PROGRAM ?></a>
		</div>

<?php

		require_once('RootBundle/views/common/table_list.php');

?>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
