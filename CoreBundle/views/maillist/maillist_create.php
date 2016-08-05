<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= MAILLIST_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/maillist/maillist_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
