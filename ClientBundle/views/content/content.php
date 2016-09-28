<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">
<link rel="stylesheet" href="ClientBundle/ressources/jOverlay-master/src/jOverlay.css">

<script src="ClientBundle/ressources/jOverlay-master/src/jquery.jOverlay.js"></script>
<script src="ClientBundle/ressources/content/js/content.js"></script>

<style>

<?php
    if (isset($designs)) {

        foreach ($designs as $design) {
?>
            <?= $design['selector'] ?> {
                <?= $design['property'] ?> : <?= $design['value'] ?>;
            }
<?php
        }
    }
?>

</style>

<div class="container">

	<div id="video_div">

<?php
		if (!count($media_files)) {
?>
		<div id="content_display_div" style="text-align: center;height: 200px;line-height: 200px; background-color: #efefef">
			<p style="margin: 0"><?= NO_CONTENT_PREVIEW ?></p>
		</div>
<?php
		}
		else {

			if  (isset($media_files[0])) {
?>
				<div id="content_display_div">
<?php
				if (strcmp($media_file['type'], "MRES") == 0) {
?>
					<video controls preload="none" width="100%">
			    		<source src="http://essilor.mediastoragekvi.fr/uploads/files/<?= $media_file['filepath'] ?>" type="<?= $media_file['mime_type'] ?>">
			    		Your browser does not support HTML5 video.
					</video>
<?php
				}
				elseif (strcmp($media_file['type'], "IMG") == 0) {
?>
					<div style="display: none">
						<img src="http://essilor.mediastoragekvi.fr/uploads/files/<?= $media_file['filepath'] ?>" style="width: 100%" />
					</div>
<?php
				}
?>
				</div>
<?php
			}
		}
?>

		<div id="video_contents_div">
<?php
			foreach ($media_files as $media_file) {

				if (strcmp($media_file['type'], "MRES") == 0) {
?>
					<div class="video_content">
						<div style="display: none">
							<video controls preload="none" width="100%">
					    		<source src="http://essilor.mediastoragekvi.fr/uploads/files/<?= $media_file['filepath'] ?>" type="<?= $media_file['mime_type'] ?>">
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
							<img src="http://essilor.mediastoragekvi.fr/uploads/files/<?= $media_file['filepath'] ?>" style="width: 100%" />
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
