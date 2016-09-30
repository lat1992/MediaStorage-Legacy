<?php

require_once('RootBundle/views/layout/header.php');

?>
	<div class="container">
<?php
		while ($organization = $organizations['data']->fetch_assoc()) {
?>
			<a style="display: inline-block;text-decoration: none;line-height: 30px;background-color: #e5e5e5;padding: 5px;margin: 10px;color: black" href="http://<?= $organization['reference'] ?>.mediastoragekvi.fr?page=folder"><?= $organization['reference'] ?> / <?= $organization['organization_name'] ?> / <?= $organization['group_name'] ?></a><br/>
<?php
		}
?>
	</div>
<?php

require_once('RootBundle/views/layout/footer.php');

?>
