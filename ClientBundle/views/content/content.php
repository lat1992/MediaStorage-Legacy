<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">

<div class="container">

	<div id="video_div">
		<video controls preload="none" width="100%">
    		<source src="http://download.blender.org/peach/trailer/trailer_1080p.ogg" type="video/ogg">
    		Your browser does not support HTML5 video.
		</video>
		<div id="video_contents_div">
<?php
			foreach ($media_files as $media_file) {
?>
				<div class="video_content"><?= $media_file['filename'] ?></div>
<?php
			}
?>
		</div>
	</div>

	<?php require_once('ClientBundle/views/content/media_info_description_list.php'); ?>

	<?php require_once('ClientBundle/views/content/media_file_action_list.php'); ?>

</div>



<?php

require_once('ClientBundle/views/layout/footer.php');

?>
