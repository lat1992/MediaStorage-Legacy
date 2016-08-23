<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<div id="container">

		<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">

		<div class="add">
			<a href="?page=create_content_admin"><?= CREATE_MEDIA_CONTENT ?></a>
		</div>

<?php

		require_once('RootBundle/views/common/table_list.php');

?>

	</div>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
