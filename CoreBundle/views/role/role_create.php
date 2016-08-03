<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= ROLE_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/role/role_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
