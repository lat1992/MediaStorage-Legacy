<?php

require_once('RootBundle/views/layout/header.php');

?>

<div id="container">

	<div class="add">
<?php
		echo '<a href="?page=create_media_info_extra_field_root&id_organization=' . $id_organization . '">' . MEDIA_INFO_EXTRA_FIELD_CREATION_TITLE . '</a>';
?>
	</div>

<?php

	require_once('RootBundle/views/common/table_list.php');

?>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
