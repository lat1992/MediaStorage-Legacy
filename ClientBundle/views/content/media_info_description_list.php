<?php

	$nb_lines = 0;

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
<?php
				$nb_lines = $nb_lines + 3;

                foreach ($media_extra as $id_info_field => $value) {

                	if ($nb_lines > count($media_extra) / 2) {
?>
						</div>

						<div class="second_div" style="width: 48%; float: left">
<?php
                	}

                    if (strcmp($value['type'], 'Text') == 0) {

                        $user_value = "";
                        if (isset($media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data']))
                            $user_value = $media_user_extras[$id_info_field]['language'][$_SESSION['id_language_mediastorage']]['data'];
?>
                        <span class="label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
<?php
                    }
					elseif (strcmp($value['type'], 'Date') == 0) {

						$user_value = "";
						if (isset($media_user_extras[$id_info_field]['data']))
							$user_value = $media_user_extras[$id_info_field]['data'];
?>
                        <span class="label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
<?php
					}
					elseif (strcmp($value['type'], 'Array_multiple') == 0) {
?>
                        <span class="label"><?= $value['data'][0]['data'] ?> : </span><span>
<?php
							foreach ($value['data'] as $row) {

								$user_value = "";
								$cpt = 0;
								if (isset($media_user_extras[$id_info_field]['multiple']) && array_search($row['id_element'], array_column($media_user_extras[$id_info_field]['multiple'], 'id_array')) !== false) {
									if ($cpt > 0)
										echo ', ' . $row['element'];
									else
										echo $row['element'];
									$cpt++;
								}

							}
?>
						</span><br />
<?php
					}
					elseif (strcmp($value['type'], 'Array_unique') == 0) {
?>
                        <span class="label"><?= $value['data'][0]['data'] ?> : </span><span>

<?php
							foreach ($value['data'] as $row) {

								$user_value = "";

								if (isset($media_user_extras[$id_info_field]['id_array']) && intval($row['id_element']) == intval($media_user_extras[$id_info_field]['id_array'])) {
									echo $row['element'];
								}
							}
?>
						</span><br />
<?php
					}
					elseif (strcmp($value['type'], 'Boolean') == 0) {

						$user_value = NO;
						if (isset($media_user_extras[$id_info_field]['data']) && intval($media_user_extras[$id_info_field]['data']))
							$user_value = YES;
?>
                        <span class="label"><?= $value['data'][0]['data'] ?> : </span><span><?= $user_value ?></span><br />
<?php
					}

					$nb_lines++;

     			}
?>
			</div>

		</div>
<?php
	}
?>