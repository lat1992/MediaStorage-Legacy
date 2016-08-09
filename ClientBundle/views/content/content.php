<?php

require_once('ClientBundle/views/layout/header.php');

?>

<!-- <link rel="stylesheet" href="ClientBundle/ressources/folder/css/folder.css">

<script src="ClientBundle/ressources/folder/js/folder.js"></script>

 -->

<style>

video {
	border: 1px solid black;
}

#video_div {
	float: left;
	width: 55%;
}

#description_div {
	float: left;
	width: 42%;
	border: 1px solid black;
}

#description_div table th {
	text-align: right;
}

.video_content {
	width: 10%;
	height: 10%;
	border: 1px solid grey;
	display: inline-block;
	float: left;
}

.clear {
	clear: both;
}

#download_link_div {
	float: left;
	border: 1px solid red;
}

</style>

<div class="container">

	<div id="video_div">
		<video controls preload="none" width="100%">
    		<source src="http://download.blender.org/peach/trailer/trailer_1080p.ogg" type="video/ogg">
    		Your browser does not support HTML5 video.
		</video>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
		<div id="video_contents_div">
			<div class="video_content"></div>
		</div>
	</div>

	<div id="description_div">
        <table id="description_table">
            <tbody>
                <tr>
                    <th>Titre :</th>
                    <td>La rose des ventsLa rose des ventsLa rose des vents</td>
                </tr>
                <tr>
                    <th>Sous-titre :</th>
                    <td>Fast and furious</td>
                </tr>
                <tr>
                    <th>Descriptif :</th>
                    <td>film de voiture</td>
                </tr>
                <tr>
                    <th>Auteur :</th>
                    <td>jenesaispas</td>
                </tr>
            </tbody>
        </table>
	</div>

	<div class="clear"></div>

	<div id="download_link_div">
        <table id="download_link_table">
            <tbody>
                <tr>
                    <th>Titre :</th>
                    <td>La rose des ventsLa rose des ventsLa rose des vents</td>
                </tr>
                <tr>
                    <th>Sous-titre :</th>
                    <td>Fast and furious</td>
                </tr>
                <tr>
                    <th>Descriptif :</th>
                    <td>film de voiture</td>
                </tr>
                <tr>
                    <th>Auteur :</th>
                    <td>jenesaispas</td>
                </tr>
            </tbody>
        </table>
	</div>

</div>



<?php

require_once('ClientBundle/views/layout/footer.php');

?>
