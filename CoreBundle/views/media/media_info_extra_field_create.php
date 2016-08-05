<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= MEDIA_INFO_EXTRA_FIELD_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/media/media_info_extra_field_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
