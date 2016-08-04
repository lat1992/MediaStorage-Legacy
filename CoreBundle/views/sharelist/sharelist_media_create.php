<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= SHARELIST_MEDIA_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/sharelist/sharelist_media_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
