<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">
<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">
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
			if  (isset($current_media_file) && intval($current_media_file['right_preview']) == 1) {
?>
				<div id="content_display_div">
<?php
				if (strpos($current_media_file['mime_type'], "video/mp4") !== false) {
?>
					<video controls preload="none" width="100%" id="video_player" poster="ClientBundle/ressources/content/img/logo-video-play.png">
			    		<source  src="<?= $current_media_file['filepath']?>" type="<?= $current_media_file['mime_type'] ?>">
			    		Your browser does not support HTML5 video.
					</video>
					<div id="video_controls">
						<div class="div_video_control div-video-padding">Temps :
							<span  id="video_timer">00:00:00
							</span>
						</div>

						<div class="div_video_control div-video-padding">Seconde :
							<span  id="video_timer_second">00.00
							</span>
						</div>

						<div class="div_video_control video_frame"><a class="button-video-control" id="prev_button" href="#"><<</a>
						</div>

						<div class="div_video_control video_frame"><a class="button-video-control" id="next_button" href="#">>></a>
						</div>

					</div>
<?php
				}
				elseif (strpos($current_media_file['mime_type'], "image") !== false) {
?>
					<div>
						<img src="<?= $current_media_file['filepath'] ?>" style="width: 100%" />
					</div>
<?php
				}
				elseif (strpos($current_media_file['mime_type'], "audio") !== false) {
?>
					<audio controls preload="none" width="100%" poster="ClientBundle/ressources/content/img/logo-video-play.png">
			    		<source  src="<?= $current_media_file['filepath']?>" type="<?= $current_media_file['mime_type'] ?>">
			    		Your browser does not support HTML5 video.
					</audio>
<?php
				}
				else {
?>
					<div id="content_display_div" style="text-align: center;height: 200px;line-height: 200px; background-color: #efefef">
						<p style="margin: 0"><?= NO_CONTENT_PREVIEW ?></p>
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
			foreach ($media_files as $key => $media_file) {
				if (intval($media_file['right_preview']) == 1) {
?>
					<a href="?page=content&media_id=<?= $_GET['media_id'] ?>&file=<?= $key ?>">
						<div class="video_content">
							<span class="content_thumbnail_header"><?= $media_file['type'] ?></span>
							<span class="content_thumbnail_body"><label class="label-content-thumbnail"><?= NAME ?></label><?= ' : ' . $media_file['filename'] ?><br /><br /><label class="label-content-thumbnail"><?= TYPE ?></label><?= ' : ' . $media_file['mime_type'] ?></span>
						</div>
					</a>
<?php
				}
			}
?>
		</div>
	</div>

<?php
		require_once('ClientBundle/views/content/media_info_description_list.php');
		if (isset($current_media_file) && strcmp($current_media_file['type'], "MRES") == 0) {
			require_once('ClientBundle/views/content/chapter_list.php');
		}
 		require_once('ClientBundle/views/content/media_file_action_list.php');
?>

</div>
<?php
if (isset($current_media_file) && strcmp($current_media_file['type'], "MRES") == 0) {
?>
	<script>

		$( document ).ready(function() {

			var video_player = document.getElementById('video_player');
			var video_timer = document.getElementById('video_timer');

			video_player.addEventListener('click',function(){
				if (video_player.paused)
					video_player.play();
				else
					video_player.pause();
			});

			video_player.addEventListener('timeupdate',function(){
				time = video_player.currentTime.toFixed(2);
				min = Math.floor(time / 60);
				timeArray = (time % 60).toFixed(2).toString().split(".");
			    video_timer.innerHTML = min.toString() + ":" + timeArray[0] + ":" + timeArray[1];
			    video_timer_second.innerHTML = time;
			});

			var prev_button = document.getElementById('prev_button');
			var next_button = document.getElementById('next_button');

			prev_button.addEventListener("click", function(event) {
				video_player.play();
				video_player.pause();
				video_player.currentTime = video_player.currentTime - 0.1;
			});

			next_button.addEventListener("click", function(event) {
				video_player.play();
				video_player.pause();
				video_player.currentTime = video_player.currentTime + 0.1;
			});

			var tc_in_button = document.getElementById('tc_in_button');
			var tc_out_button = document.getElementById('tc_out_button');
			var tc_in_input = document.getElementById('tc_in_input');
			var tc_out_input = document.getElementById('tc_out_input');

			tc_in_button.addEventListener("click", function(event) {
				tc_in_input.value = video_player.currentTime.toFixed(2);
			});

			tc_out_button.addEventListener("click", function(event) {
				tc_out_input.value = video_player.currentTime.toFixed(2);
			});

			$(".chapter_link").on("click", function(event) {
				video_player.currentTime = $(this).parent().parent().find(".tc_in").html();

				if (video_player.paused)
					video_player.play();

				tc_out_time = parseInt($(this).parent().parent().find(".tc_out").html());

				video_player.addEventListener('timeupdate',function(){
					if (video_player.currentTime > tc_out_time) {
							video_player.pause();
							this.removeEventListener('timeupdate',arguments.callee,false);
					}
				});
			});
		});
	</script>
<?php
}

require_once('ClientBundle/views/layout/footer.php');

?>
