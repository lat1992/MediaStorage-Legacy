<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= LANGUAGE_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/language/language_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
