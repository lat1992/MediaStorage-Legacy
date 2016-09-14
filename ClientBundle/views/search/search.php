<?php
require_once('ClientBundle/views/layout/header.php');
?>
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/search/css/styles.css" />
<div class="searchbox">
    <form method="get">
    	<input type="hidden" name="page" value="search">
        <input type="text" id="search" name="search" />
        <input type="submit" value="&#x1f50d;" id="submitButton" />
    </form>
</div>
<?php
require_once('ClientBundle/views/layout/footer.php');
?>
