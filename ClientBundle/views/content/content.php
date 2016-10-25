<?php

require_once('ClientBundle/views/layout/header.php');

?>

<link rel="stylesheet" href="ClientBundle/ressources/content/css/content.css">
<link rel="stylesheet" href="ClientBundle/ressources/jOverlay-master/src/jOverlay.css">

<script src="ClientBundle/ressources/jOverlay-master/src/jquery.jOverlay.js"></script>
<script src="ClientBundle/ressources/content/js/content.js"></script>

<style>

	#chapter_table td.td-link {
		padding: 0px;
	}

	a.td-link-button, div.div_video_control a.button-video-control {
		display: inline-block;
		line-height: 40px;
		width: 100%;
		text-align: center;
		text-decoration: none;
	}

	a.button, button.button, label.label-chapter {
		display: inline-block;
		line-height: 40px;
		text-align: center;
		text-decoration: none;
		border: none;
		padding: 0 10px 0 10px;
		margin: 5px 0 5px 0;
	}

	a.button {
		width: 80px;
	}

	button.button {
		background:none;
		border:none;
		font-size:1em;
		color:blue;
		font-weight: normal;
		width: 120px;
	}

	a.button-chapter, label.label-chapter {
		width: 80px;
	}

	input.input-line-height {
		line-height: 25px;
		padding: 2px 5px 2px 5px;
	}

	div.div_video_control {
		text-align: center;
		display: inline-block;
		width: 170px;
		line-height: 30px;
		margin: 15px 0 0 0;
	}

	div.div-video-padding {
		padding: 5px;
	}

	div.div_video_control {
		color: #000000;
		background-color: #d5d5d5;
	}

	label.label-chapter {
		color: #000000;
		background-color: #dfdfdf;
	}

	a.delete-button {
		background-color: #ff6666;
		color: #ffffff;
	}

	a.delete-button:hover {
		background-color: #ff3333;
		color: #ffffff;
	}

	#chapter_table tr:hover td, #download_link_table tr:hover td{
		background-color: #eaeaea;
	}

	a.chapter-button {
		background-color: #999999;
		color: #ffffff;
	}

	a.chapter-button:hover {
		background-color: #777777;
		color: #ffffff;
	}

	a.button, button.button, div.div_video_control a.button-video-control {
		background-color: #999999;
		color: #ffffff;
	}

	a.button:hover, button.button:hover, div.div_video_control a.button-video-control:hover {
		background-color: #777777;
		color: #ffffff;
	}

	button.button-validate {
		color: #ffffff;
		background-color: #7bd55d;
	}

	button.button-validate:hover {
		color: #ffffff;
		background-color: #5acb34;
	}

	#download_link_table a {
		background-color: #66c2ff;
		color: #ffffff;
	}

	#download_link_table a:hover {
		background-color: #33adff;
		color: #ffffff;
	}

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
			if  (isset($current_media_file)) {
?>
				<div id="content_display_div">
<?php
				if (strcmp($current_media_file['type'], "MRES") == 0) {
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

						<div class="div_video_control"><a class="button-video-control" id="prev_button" href="#"><<</a>
						</div>

						<div class="div_video_control"><a class="button-video-control" id="next_button" href="#">>></a>
						</div>

					</div>
<?php
				}
				elseif (strcmp($current_media_file['type'], "IMG") == 0) {
?>
					<div>
						<img src="<?= $current_media_file['filepath'] ?>" style="width: 100%" />
					</div>
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
?>
				<a href="?page=content&media_id=<?= $_GET['media_id'] ?>&file=<?= $key ?>">
					<div class="video_content">
						<span class="content_thumbnail_header"><?= $media_file['type'] ?></span>
						<span class="content_thumbnail_body"><label class="label-content-thumbnail"><?= NAME ?></label><?= ' : ' . $media_file['filename'] ?><br /><br /><label class="label-content-thumbnail"><?= TYPE ?></label><?= ' : ' . $media_file['mime_type'] ?></span>
					</div>
				</a>
<?php
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
