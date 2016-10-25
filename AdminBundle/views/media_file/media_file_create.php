<?php

require_once('ClientBundle/views/layout/header.php');

?>

	<link rel="stylesheet" href="AdminBundle/ressources/fine-uploader/fine-uploader-new.css">
	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
	<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

	<?php require_once('AdminBundle/views/media_file/media_file_create_form.php'); ?>

	<script src="AdminBundle/ressources/fine-uploader/fine-uploader.js"></script>

	<script>

		$( document ).ready(function() {
			$("a.qualification-button").on('click', function(){
				$('.input-checkbox').prop('checked', false);
				$(this).parent().parent().find(".input-checkbox").prop('checked', true);
				$("#form_media_file").submit();
			});
		})

	</script>

<?php

require_once('ClientBundle/views/layout/footer.php');

?>
