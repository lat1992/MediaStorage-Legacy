<?php

require_once('CoreBundle/views/layout/header.php');

require_once('CoreBundle/views/layout/menu.php');

?>

<span><?= CHAPTER_CREATION_TITLE ?></span>

<div>

	<?php require_once('CoreBundle/views/chapter/chapter_create_form.php'); ?>

</div>

<?php

require_once('CoreBundle/views/layout/footer.php');

?>
