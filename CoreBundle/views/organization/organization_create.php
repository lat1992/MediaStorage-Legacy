<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= ORGANIZATION_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/organization/organization_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
