<?php
	foreach ($media_infos as $media_info) {
?>
		<div id="description_div">
	        <table id="description_table">
	            <tbody>

	                <tr>
	                    <td><?= TITLE ?> :</td>
	                    <td><?= $media_info['title'] ?></td>
	                </tr>
	                <tr>
	                    <td><?= SUBTITLE ?> :</td>
	                    <td><?= $media_info['subtitle'] ?></td>
	                </tr>
	                <tr>
	                    <td><?= DESCRIPTION ?> :</td>
	                    <td><?= $media_info['description'] ?></td>
	                </tr>
	                <tr>
	                    <td><?= EPISODE_NUMBER ?> :</td>
	                    <td><?= $media_info['episode_number'] ?></td>
	                </tr>
	                <tr>
	                    <td><?= IMAGE_VERSION ?> :</td>
	                    <td><?= $media_info['image_version'] ?></td>
	                </tr>
	                <tr>
	                    <td><?= SOUND_VERSION ?> :</td>
	                    <td><?= $media_info['sound_version'] ?></td>
	                </tr>

	                <?php require_once('ClientBundle/views/content/media_extra_list.php'); ?>

	            </tbody>
	        </table>
		</div>
<?php
	}
?>