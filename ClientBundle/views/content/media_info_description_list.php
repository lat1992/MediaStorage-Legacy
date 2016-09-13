<?php
	foreach ($media_infos as $media_info) {
?>
		<div id="description_div">
<?php /*	        <table id="description_table">
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
*/ ?>

			<div class="first_div" style="width: 48%; float: left">
				<span class="label"><?= TITLE ?> : </span><?= $media_info['title'] ?><br />
				<span class="label"><?= SUBTITLE ?> : </span><?= (isset($media_infos['subtitle'])) ? : '' ?><br />
				<span class="label"><?= DESCRIPTION ?> : </span><?= (isset($media_infos['description'])) ? : '' ?><br />

			</div>

			<div class="second_div" style="width: 48%; float: left">
				<span class="label">Test : </span>test<br />
			</div>

		</div>
<?php
	}
?>