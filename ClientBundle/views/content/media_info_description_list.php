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

	                <?php require_once('ClientBundle/views/content/media_extra_list.php'); ?>

	            </tbody>
	        </table>
		</div>
<?php
	}
?>