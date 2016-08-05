<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= FOLDER_LANGUAGE_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/folder/folder_language_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
