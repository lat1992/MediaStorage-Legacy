<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">
<link rel="stylesheet" href="ClientBundle/ressources/jOverlay-master/src/jOverlay.css">

<script src="ClientBundle/ressources/jOverlay-master/src/jquery.jOverlay.js"></script>
<script src="ClientBundle/ressources/content/js/content.js"></script>


<div class="container">

	<div id="video_div">

		<div id="content_display_div">
			<video controls preload="none" width="100%">
	    		<source src="http://download.blender.org/peach/trailer/trailer_1080p.ogg" type="video/ogg">
	    		Your browser does not support HTML5 video.
			</video>
		</div>

		<div id="video_contents_div">
<?php
			foreach ($media_files as $media_file) {

				if (strcmp($media_file['type'], "MRES") == 0) {
?>
					<div class="video_content">
						<div style="display: none">
							<video controls preload="none" width="100%">
					    		<source src="http://download.blender.org/peach/trailer/trailer_1080p.ogg" type="video/ogg">
					    		Your browser does not support HTML5 video.
							</video>
						</div>
						<span class="content_thumbnail_header"><?= $media_file['type'] ?></span>
						<span><?= $media_file['filename'] ?></span>
					</div>
<?php
				}
				elseif (strcmp($media_file['type'], "IMG") == 0) {
?>
					<div class="video_content">
						<div style="display: none">
							<img src="http://essilor.mediastoragekvi.fr/uploads/files/<?= $media_file['filepath'] ?>" />
						</div>
						<span class="content_thumbnail_header"><?= $media_file['type'] ?></span>
						<span><?= $media_file['filename'] ?></span>
					</div>
<?php
				}
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
