<?php
require_once('ClientBundle/views/layout/header.php');
?>
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/search/css/styles.css" />
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
<div class="search-box">
    <form method="get">
    	<div class="search-form">
    		<input type="hidden" name="page" value="search">
        	<input type="text" id="keyword" name="keyword" onkeyup="ajaxRefreshLiveSearch(this.value)" autocomplete="off" />
    		<input type="hidden" name="paginate" value="1">
        	<input type="submit" value="&#x1f50d;" id="submitButton" />
        </div>
        <div style="clear:both"></div>
    	<div class="live-search" id="livesearch"></div>
    </form>
</div>
    <div class="container">
<?php
	if (isset($folder_data)) {
		if (isset($folder_data->num_rows) && intval($folder_data->num_rows) != 0) {
?>
			<span class="category_title category_title_folder"><?= FOLDER ?></span>
<?php
		}
		while ($folder = $folder_data->fetch_assoc()) {
?>
			<a class="link_div_folder" href="?page=folder&parent_id=<?= $folder['id']; ?>" >
                <div class="hvr-grow col folder">
                    <div class="folder_title_div">
                        <span class="folder_title_span" ><?= $folder['data'] ?></span>
                    </div>
                    <div class="folder_image_div">
                        <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
                        <img class="folder_image" src="ClientBundle/ressources/folder/img/default_folder.png" />
                    </div>

                    <div class="folder_description">
<?php
                        if (isset($folder['description']) && $folder['description']) {
?>
                            <span class="description_label"><?= DESCRIPTION ?> : </span><span><?= $folder['description'] ?></span>
<?php
                        }
                        else {
                            echo '<span class="program_description_empty">' . NO_DESCRIPTION_AVAILABLE . '</span>';
                        }
?>
                    </div>
                </div>
            </a>
<?php
		}
    }

    if (isset($program_data)) {

        if (isset($program_data->num_rows) && intval($program_data->num_rows) != 0) {
?>
            <span class="category_title category_title_program" ><?= PROGRAM ?></span>
<?php
        }
        while ($program = $program_data->fetch_assoc()) {
?>
            <a class="link_div_program" href="?page=program&media_id=<?= $program['id']; ?>" >
                <div class="hvr-grow col program">

                    <div class="program_title_div">
                        <span class="program_title_span" ><?= $program['title'] ?></span>
                    </div>

                    <div class="program_image_div">
                        <!-- <img src="ClientBundle/ressources/program/img/default.png" /> -->
                        <img class="program_image" src="<?php if (file_exists('uploads/thumbnails/files/8/programs/thumbnail_program_'.$program['id'].'.png')) echo 'uploads/thumbnails/files/8/programs/thumbnail_program_'.$program['id'].'.png'; else echo 'ClientBundle/ressources/program/img/default_program.png'; ?>" />
                    </div>

                    <div class="program_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $program['reference_client'] ?></span><br />
<?php
                        if (isset($program['subtitle']) && $program['subtitle']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $program['subtitle'] ?></span>
<?php
                        }
?>
                    </div>
                </div>
            </a>
<?php
        }
    }

    if (isset($content_data)) {

        if (isset($content_data->num_rows) && intval($content_data->num_rows) != 0) {
?>
            <span class="category_title category_title_content" ><?= CONTENT ?></span>
<?php
        }
        while ($content = $content_data->fetch_assoc()) {
?>
            <a class="link_div_content" href="?page=content&media_id=<?= $content['id']; ?>" >
                <div class="hvr-grow col content">

                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['title'] ?></span>
                    </div>

                    <div class="content_image_div">
                        <!-- <img src="ClientBundle/ressources/content/img/default.png" /> -->
                        <img class="content_image" src="ClientBundle/ressources/content/img/default_content.png" />
                    </div>

                    <div class="content_description">

                        <span class="description_label"><?= REFERENCE ?> : </span><span><?= $content['reference_client'] ?></span><br />
<?php
                        if (isset($content['description']) && $content['description']) {
?>
                            <span class="description_label"><?= SUBTITLE ?> : </span><span><?= $content['subtitle'] ?></span>
<?php
                        }
?>
                    </div>
                </div>
            </a>
 <?php
        }
    }
?>
    </div>

<script>
	function ajaxRefreshLiveSearch(value) {
		if (value){
			$.ajax({
				url: "?page=ajax_refresh_live_search&keyword="+value,
				type: 'GET',
				success: function(result, status) {
					if (!result) {
						return ;
					}
					var data = JSON.parse(result);
					var $html = '';
					for (var i = 0; i < data.length; i++) {
						$html += '<div class="livesearch-result"><a href="?page=search&keyword='+ data[i].data +'&paginate=1">' + data[i].data + '</a></div>';
					}
					$('#livesearch').html($html);
				},
				error: function(result, status, error) {
					console.log('ERROR : ');
					console.log(error);
				}
			});
		}
		else {
			$('#livesearch').html('');
		}
	}
</script>

<?php
require_once('ClientBundle/views/layout/footer.php');
?>
