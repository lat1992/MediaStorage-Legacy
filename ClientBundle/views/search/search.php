<?php
require_once('ClientBundle/views/layout/header.php');
?>
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/search/css/styles.css" />
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/folder/css/folder.css" />
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/content/css/button.css" />
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
            <div class="hvr-grow col folder">

                <a href="?page=folder&parent_id=<?= $folder['id']; ?>" >
                    <div class="folder_title_div">
                        <span class="folder_title_span" ><?= $folder['data'] ?></span>
                    </div>
                </a>
                <div class="folder_image_div">
                    <!-- <img src="ClientBundle/ressources/folder/img/default.png" /> -->
                    <a href="?page=folder&parent_id=<?= $folder['id']; ?>" >
                        <img class="folder_image" src="<?php if file_exists('uploads/thumbnails/files/'.$_SESSION['id_organization'].'/folders/thumbnail_folder_'.$folder['id'].'.png') echo 'uploads/thumbnails/files/'.$_SESSION['id_organization'].'/folders/thumbnail_folder_'.$folder['id'].'.png'; else echo 'ClientBundle/ressources/folder/img/default_folder.png'; ?>" />
                    </a>
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
<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_folder_admin&folder_id=<?= $folder['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
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
            <div class="hvr-grow col program">

                <a href="?page=program&media_id=<?= $program['id']; ?>" >
                    <div class="program_title_div">
                        <span class="program_title_span" ><?= $program['title'] ?></span>
                    </div>
                </a>

                <div class="program_image_div">
                    <!-- <img src="ClientBundle/ressources/program/img/default.png" /> -->
                    <a href="?page=program&media_id=<?= $program['id']; ?>" >
                        <img class="program_image" src="<?php if (file_exists('uploads/thumbnails/files/'.$_SESSION['id_organization'].'/programs/thumbnail_program_'.$program['id'].'.png')) echo 'uploads/thumbnails/files/'.$_SESSION['id_organization'].'/programs/thumbnail_program_'.$program['id'].'.png'; else echo 'ClientBundle/ressources/program/img/default_program.png'; ?>" />
                    </a>
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
<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_program_admin&media_id=<?= $program['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
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
            <div class="hvr-grow col content">

                <a href="?page=content&media_id=<?= $content['id']; ?>" >
                    <div class="content_title_div">
                        <span class="content_title_span" ><?= $content['title'] ?></span>
                    </div>
                </a>

                <div class="content_image_div">
                    <!-- <img src="ClientBundle/ressources/content/img/default.png" /> -->
                    <a href="?page=content&media_id=<?= $content['id']; ?>" >
                        <img class="content_image" src="<?php if (file_exists('uploads/thumbnails/files/'.$_SESSION['id_organization'].'/contents/thumbnail_content_'.$content['id'].'.png')) echo 'uploads/thumbnails/files/'.$_SESSION['id_organization'].'/contents/thumbnail_content_'.$content['id'].'.png'; else echo 'ClientBundle/ressources/content/img/default_content.png'; ?>" />
                    </a>
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
<?php
                if (isset($_SESSION['permits'][PERMIT_EDIT_CONTENT])) {
?>
                    <a class="button-edit-from-view" href="?page=edit_content_admin&media_id=<?= $content['id'] ?>"><?= EDIT ?></a>
<?php
                }
?>
            </div>
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
