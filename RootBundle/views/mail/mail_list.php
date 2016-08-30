<?php

require_once('RootBundle/views/layout/header.php');

?>

<div id="container">

	<div class="add">
		<a href="?page=create_mail_root&id_organization=<?= $id_organization ?>"><?= MAIL_CREATION_TITLE ?></a>
	</div>

<?php

	require_once('RootBundle/views/common/table_list.php');

?>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
