<?php

require_once('ClientBundle/views/layout/header.php');

?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="AdminBundle/ressources/tag-it-master/js/tag-it.js" type="text/javascript" charset="utf-8"></script>

    <link href="AdminBundle/ressources/tag-it-master/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="AdminBundle/ressources/tag-it-master/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">

	<script src="AdminBundle/ressources/media/js/media.js"></script>
	<script src="AdminBundle/ressources/fine-uploader/fine-uploader.js"></script>

	<link rel="stylesheet" href="CoreBundle/ressources/layout/css/form.css">
	<link rel="stylesheet" href="AdminBundle/ressources/fine-uploader/fine-uploader-new.css">
	<link rel="stylesheet" href="ClientBundle/ressources/content/css/button.css">

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

	<div id="container">

		<form id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<a class="button button-delete margin-top" href="?page=list_program_admin"><?= CANCEL ?></a>
		<a class="button button-validate margin-left margin-top" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>


		<h2><?= DESCRIPTIVE_NOTICE ?></h2>

<?php
		$path = "";
		if (isset($_GET['media_id'])) {
			$path = "?page=upload_program_thumbnail_admin&media_id=" . $_GET['media_id'];
		}
		$type = "program";

		require_once('AdminBundle/views/media/media_create_form.php');
?>

		<br />

		<?php require_once('AdminBundle/views/media/media_info_create_form.php'); ?>

		<br />

		<h2><?= TAG ?></h2>
        <ul id="myULTags">
<?php
		if (isset($actual_tags)) {
			foreach ($actual_tags as $actual_tag) {
				echo '<li>' . $actual_tag . '</li>';
			}
		}
?>
        </ul>

		<input type="hidden" name="id_media_create_mediastorage" value="895143" />

		<a class="button button-delete margin-top" href="?page=list_program_admin"><?= CANCEL ?></a>
		<a class="button button-validate margin-left margin-top" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

		</form>

	</div>

<script>
			var sampleTags = [<?php
				foreach ($tags_proposition_data as $value) {
					echo '"' . $value . '", ';
				}
			?>];
            $('#myULTags').tagit({
                availableTags: sampleTags, // this param is of course optional. it's for autocomplete.
                // configure the name of the input field (will be submitted with form), default: item[tags]
                itemName: 'item[]',
                fieldName: 'tags[]'
            });
</script>


<?php

require_once('ClientBundle/views/layout/footer.php');

?>
