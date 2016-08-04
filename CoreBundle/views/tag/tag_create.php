<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= TAG_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/tag/tag_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
