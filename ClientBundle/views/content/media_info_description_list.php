<?php
	foreach ($media_infos as $media_info) {
?>
		<div id="description_div">
	        <table id="description_table">
	            <tbody>

	                <tr>
	                    <th><?= TITLE ?> :</th>
	                    <td><?= $media_info['title'] ?></td>
	                </tr>
	                <tr>
	                    <th><?= SUBTITLE ?> :</th>
	                    <td><?= $media_info['subtitle'] ?></td>
	                </tr>
	                <tr>
	                    <th><?= DESCRIPTION ?> :</th>
	                    <td><?= $media_info['description'] ?></td>
	                </tr>
	                <tr>
	                    <th><?= EPISODE_NUMBER ?> :</th>
	                    <td><?= $media_info['episode_number'] ?></td>
	                </tr>
	                <tr>
	                    <th><?= IMAGE_VERSION ?> :</th>
	                    <td><?= $media_info['image_version'] ?></td>
	                </tr>
	                <tr>
	                    <th><?= SOUND_VERSION ?> :</th>
	                    <td><?= $media_info['sound_version'] ?></td>
	                </tr>

	            </tbody>
	        </table>
		</div>
<?php
	}
?>