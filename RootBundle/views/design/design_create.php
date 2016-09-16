<?php

require_once('RootBundle/views/layout/header.php');

?>
<link rel="stylesheet" href="RootBundle/ressources/design/css/design.css">
<script src="RootBundle/ressources/design/js/design.js"></script>

<div id="container">

	<form id="form" class="design-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?' . $_SERVER['QUERY_STRING']); ?>" method="POST">

		<h2><?= LOGIN_PAGE ?></h2>

		<h3><?= GENERAL ?></h3>

		<label for="design_mediastorage[body][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[body][background-color][value]" id="design_mediastorage[body][background-color][value]" value="<?= (isset($designs['body']['background-color']['value'])) ? $designs['body']['background-color']['value'] : '#a6a6a6' ?>" />
		<input type="text" name="design_mediastorage[body][background-color][value]"  value="<?= (isset($designs['body']['background-color']['value'])) ? $designs['body']['background-color']['value'] : '#a6a6a6' ?>"><br />
		<input type="hidden" name="design_mediastorage[body][background-color][id]" value="<?= (isset($designs['body']['background-color']['id'])) ? $designs['body']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[body][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[body][color][value]" id="design_mediastorage[body][color][value]" value="<?= (isset($designs['body']['color']['value'])) ? $designs['body']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[body][color][value]" id="design_mediastorage[body][color][value]" value="<?= (isset($designs['body']['color']['value'])) ? $designs['body']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[body][color][id]" value="<?= (isset($designs['body']['color']['id'])) ? $designs['body']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= LOGIN_BLOCK ?></h3>

		<label for="design_mediastorage[.form][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form][background-color][value]" id="design_mediastorage[.form][background-color][value]" value="<?= (isset($designs['.form']['background-color']['value'])) ? $designs['.form']['background-color']['value'] : '#f2f2f2' ?>" />
		<input type="text" name="design_mediastorage[.form][background-color][value]" id="design_mediastorage[.form][background-color][value]" value="<?= (isset($designs['.form']['background-color']['value'])) ? $designs['.form']['background-color']['value'] : '#f2f2f2' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form][background-color][id]" value="<?= (isset($designs['.form']['background-color']['id'])) ? $designs['.form']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form][color][value]" id="design_mediastorage[.form][color][value]" value="<?= (isset($designs['.form']['color']['value'])) ? $designs['.form']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[.form][color][value]" id="design_mediastorage[.form][color][value]" value="<?= (isset($designs['.form']['color']['value'])) ? $designs['.form']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form][color][id]" value="<?= (isset($designs['.form']['color']['id'])) ? $designs['.form']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= BUTTON ?></h3>

		<label for="design_mediastorage[.form button][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form button][background-color][value]" id="design_mediastorage[.form button][background-color][value]" value="<?= (isset($designs['.form button']['background-color']['value'])) ? $designs['.form button']['background-color']['value'] : '#404040' ?>" />
		<input type="text" name="design_mediastorage[.form button][background-color][value]" id="design_mediastorage[.form button][background-color][value]" value="<?= (isset($designs['.form button']['background-color']['value'])) ? $designs['.form button']['background-color']['value'] : '#404040' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button][background-color][id]" value="<?= (isset($designs['.form button']['background-color']['id'])) ? $designs['.form button']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.form button][color][value]" id="design_mediastorage[.form button][color][value]" value="<?= (isset($designs['.form button']['color']['value'])) ? $designs['.form button']['color']['value'] : '#d9d9d9' ?>" />
		<input type="text" name="design_mediastorage[.form button][color][value]" id="design_mediastorage[.form button][color][value]" value="<?= (isset($designs['.form button']['color']['value'])) ? $designs['.form button']['color']['value'] : '#d9d9d9' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button][color][id]" value="<?= (isset($designs['.form button']['color']['id'])) ? $designs['.form button']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'] : '#FED500' ?>" /><
		<input type="text" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['value'] : '#FED500' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][background-color][id]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['background-color']['id'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['value'] : '#262626' ?>" />
		<input type="text" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" id="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][value]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['value'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['value'] : '#262626' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.form button:hover,.form button:active,.form button:focus][color][id]" value="<?= (isset($designs['.form button:hover,.form button:active,.form button:focus']['color']['id'])) ? $designs['.form button:hover,.form button:active,.form button:focus']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h2><?= HOMEPAGE ?></h2>

		<h3><?= GENERAL ?></h3>

		<label for="design_mediastorage[div.div_canvas][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.div_canvas][background-color][value]" id="design_mediastorage[div.div_canvas][background-color][value]" value="<?= (isset($designs['div.div_canvas']['background-color']['value'])) ? $designs['div.div_canvas']['background-color']['value'] : '#f5f4f2' ?>" />
		<input type="text" name="design_mediastorage[div.div_canvas][background-color][value]"  value="<?= (isset($designs['div.div_canvas']['background-color']['value'])) ? $designs['div.div_canvas']['background-color']['value'] : '#f5f4f2' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.div_canvas][background-color][id]" value="<?= (isset($designs['div.div_canvas']['background-color']['id'])) ? $designs['div.div_canvas']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= TOP_MENU ?></h3>

		<label for="design_mediastorage[nav.nav_canvas][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[nav.nav_canvas][background-color][value]" id="design_mediastorage[nav.nav_canvas][background-color][value]" value="<?= (isset($designs['nav.nav_canvas']['background-color']['value'])) ? $designs['nav.nav_canvas']['background-color']['value'] : '#404040' ?>" />
		<input type="text" name="design_mediastorage[nav.nav_canvas][background-color][value]"  value="<?= (isset($designs['nav.nav_canvas']['background-color']['value'])) ? $designs['nav.nav_canvas']['background-color']['value'] : '#404040' ?>"><br />
		<input type="hidden" name="design_mediastorage[nav.nav_canvas][background-color][id]" value="<?= (isset($designs['nav.nav_canvas']['background-color']['id'])) ? $designs['nav.nav_canvas']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[nav.nav_canvas][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[nav.nav_canvas][color][value]" id="design_mediastorage[nav.nav_canvas][color][value]" value="<?= (isset($designs['nav.nav_canvas']['color']['value'])) ? $designs['nav.nav_canvas']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[nav.nav_canvas][color][value]" id="design_mediastorage[nav.nav_canvas][color][value]" value="<?= (isset($designs['nav.nav_canvas']['color']['value'])) ? $designs['nav.nav_canvas']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[nav.nav_canvas][color][id]" value="<?= (isset($designs['nav.nav_canvas']['color']['id'])) ? $designs['nav.nav_canvas']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= TOP_MENU_FOLDER_LINK ?></h3>

		<label for="design_mediastorage[.to_hide_mobile a][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.to_hide_mobile a][color][value]" id="design_mediastorage[.to_hide_mobile a][color][value]" value="<?= (isset($designs['.to_hide_mobile a']['color']['value'])) ? $designs['.to_hide_mobile a']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[.to_hide_mobile a][color][value]" id="design_mediastorage[.to_hide_mobile a][color][value]" value="<?= (isset($designs['.to_hide_mobile a']['color']['value'])) ? $designs['.to_hide_mobile a']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.to_hide_mobile a][color][id]" value="<?= (isset($designs['.to_hide_mobile a']['color']['id'])) ? $designs['.to_hide_mobile a']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= SIDE_MENU ?></h3>

		<label for="design_mediastorage[.off-canvas][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.off-canvas][background-color][value]" id="design_mediastorage[.off-canvas][background-color][value]" value="<?= (isset($designs['.off-canvas']['background-color']['value'])) ? $designs['.off-canvas']['background-color']['value'] : '#404040' ?>" />
		<input type="text" name="design_mediastorage[.off-canvas][background-color][value]"  value="<?= (isset($designs['.off-canvas']['background-color']['value'])) ? $designs['.off-canvas']['background-color']['value'] : '#404040' ?>"><br />
		<input type="hidden" name="design_mediastorage[.off-canvas][background-color][id]" value="<?= (isset($designs['.off-canvas']['background-color']['id'])) ? $designs['.off-canvas']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.off-canvas a][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.off-canvas a][color][value]" id="design_mediastorage[.off-canvas a][color][value]" value="<?= (isset($designs['.off-canvas a']['color']['value'])) ? $designs['.off-canvas a']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[.off-canvas a][color][value]" id="design_mediastorage[.off-canvas a][color][value]" value="<?= (isset($designs['.off-canvas a']['color']['value'])) ? $designs['.off-canvas a']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.off-canvas a][color][id]" value="<?= (isset($designs['.off-canvas a']['color']['id'])) ? $designs['.off-canvas a']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.off-canvas a:hover][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.off-canvas a:hover][background-color][value]" id="design_mediastorage[.off-canvas a:hover][background-color][value]" value="<?= (isset($designs['.off-canvas a:hover']['background-color']['value'])) ? $designs['.off-canvas a:hover']['background-color']['value'] : '#00ff99' ?>" /><
		<input type="text" name="design_mediastorage[.off-canvas a:hover][background-color][value]" id="design_mediastorage[.off-canvas a:hover][background-color][value]" value="<?= (isset($designs['.off-canvas a:hover']['background-color']['value'])) ? $designs['.off-canvas a:hover']['background-color']['value'] : '#00ff99' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.off-canvas a:hover][background-color][id]" value="<?= (isset($designs['.off-canvas a:hover']['background-color']['id'])) ? $designs['.off-canvas a:hover']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.off-canvas a:hover][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[.off-canvas a:hover][color][value]" id="design_mediastorage[.off-canvas a:hover][color][value]" value="<?= (isset($designs['.off-canvas a:hover']['color']['value'])) ? $designs['.off-canvas a:hover']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[.off-canvas a:hover][color][value]" id="design_mediastorage[.off-canvas a:hover][color][value]" value="<?= (isset($designs['.off-canvas a:hover']['color']['value'])) ? $designs['.off-canvas a:hover']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.off-canvas a:hover][color][id]" value="<?= (isset($designs['.off-canvas a:hover']['color']['id'])) ? $designs['.off-canvas a:hover']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= PROFILE_BUTTON ?></h3>

		<label for="design_mediastorage[.profile_button][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.profile_button][background-color][value]" id="design_mediastorage[.profile_button][background-color][value]" value="<?= (isset($designs['.profile_button']['background-color']['value'])) ? $designs['.profile_button']['background-color']['value'] : '#005c99' ?>" />
		<input type="text" name="design_mediastorage[.profile_button][background-color][value]"  value="<?= (isset($designs['.profile_button']['background-color']['value'])) ? $designs['.profile_button']['background-color']['value'] : '#005c99' ?>"><br />
		<input type="hidden" name="design_mediastorage[.profile_button][background-color][id]" value="<?= (isset($designs['.profile_button']['background-color']['id'])) ? $designs['.profile_button']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.profile_button][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.profile_button][color][value]" id="design_mediastorage[.profile_button][color][value]" value="<?= (isset($designs['.profile_button']['color']['value'])) ? $designs['.profile_button']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[.profile_button][color][value]" id="design_mediastorage[.profile_button][color][value]" value="<?= (isset($designs['.profile_button']['color']['value'])) ? $designs['.profile_button']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.profile_button][color][id]" value="<?= (isset($designs['.profile_button']['color']['id'])) ? $designs['.profile_button']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[ul li a.profile_button:hover][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[ul li a.profile_button:hover][background-color][value]" id="design_mediastorage[ul li a.profile_button:hover][background-color][value]" value="<?= (isset($designs['ul li a.profile_button:hover']['background-color']['value'])) ? $designs['ul li a.profile_button:hover']['background-color']['value'] : '#0099ff' ?>" /><
		<input type="text" name="design_mediastorage[ul li a.profile_button:hover][background-color][value]" id="design_mediastorage[ul li a.profile_button:hover][background-color][value]" value="<?= (isset($designs['ul li a.profile_button:hover']['background-color']['value'])) ? $designs['ul li a.profile_button:hover']['background-color']['value'] : '#0099ff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[ul li a.profile_button:hover][background-color][id]" value="<?= (isset($designs['ul li a.profile_button:hover']['background-color']['id'])) ? $designs['ul li a.profile_button:hover']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[ul li a.profile_button:hover][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[ul li a.profile_button:hover][color][value]" id="design_mediastorage[ul li a.profile_button:hover][color][value]" value="<?= (isset($designs['ul li a.profile_button:hover']['color']['value'])) ? $designs['ul li a.profile_button:hover']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[ul li a.profile_button:hover][color][value]" id="design_mediastorage[ul li a.profile_button:hover][color][value]" value="<?= (isset($designs['ul li a.profile_button:hover']['color']['value'])) ? $designs['ul li a.profile_button:hover']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[ul li a.profile_button:hover][color][id]" value="<?= (isset($designs['ul li a.profile_button:hover']['color']['id'])) ? $designs['ul li a.profile_button:hover']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= LOGOUT_BUTTON ?></h3>

		<label for="design_mediastorage[.logout_button][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.logout_button][background-color][value]" id="design_mediastorage[.logout_button][background-color][value]" value="<?= (isset($designs['.logout_button']['background-color']['value'])) ? $designs['.logout_button']['background-color']['value'] : '#990000' ?>" />
		<input type="text" name="design_mediastorage[.logout_button][background-color][value]"  value="<?= (isset($designs['.logout_button']['background-color']['value'])) ? $designs['.logout_button']['background-color']['value'] : '#990000' ?>"><br />
		<input type="hidden" name="design_mediastorage[.logout_button][background-color][id]" value="<?= (isset($designs['.logout_button']['background-color']['id'])) ? $designs['.logout_button']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.logout_button][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.logout_button][color][value]" id="design_mediastorage[.logout_button][color][value]" value="<?= (isset($designs['.logout_button']['color']['value'])) ? $designs['.logout_button']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[.logout_button][color][value]" id="design_mediastorage[.logout_button][color][value]" value="<?= (isset($designs['.logout_button']['color']['value'])) ? $designs['.logout_button']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.logout_button][color][id]" value="<?= (isset($designs['.logout_button']['color']['id'])) ? $designs['.logout_button']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[ul li a.logout_button:hover][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[ul li a.logout_button:hover][background-color][value]" id="design_mediastorage[ul li a.logout_button:hover][background-color][value]" value="<?= (isset($designs['ul li a.logout_button:hover']['background-color']['value'])) ? $designs['ul li a.logout_button:hover']['background-color']['value'] : '#ff1a1a' ?>" /><
		<input type="text" name="design_mediastorage[ul li a.logout_button:hover][background-color][value]" id="design_mediastorage[ul li a.logout_button:hover][background-color][value]" value="<?= (isset($designs['ul li a.logout_button:hover']['background-color']['value'])) ? $designs['ul li a.logout_button:hover']['background-color']['value'] : '#ff1a1a' ?>" /><br />
		<input type="hidden" name="design_mediastorage[ul li a.logout_button:hover][background-color][id]" value="<?= (isset($designs['ul li a.logout_button:hover']['background-color']['id'])) ? $designs['ul li a.logout_button:hover']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[ul li a.logout_button:hover][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[ul li a.logout_button:hover][color][value]" id="design_mediastorage[ul li a.logout_button:hover][color][value]" value="<?= (isset($designs['ul li a.logout_button:hover']['color']['value'])) ? $designs['ul li a.logout_button:hover']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[ul li a.logout_button:hover][color][value]" id="design_mediastorage[ul li a.logout_button:hover][color][value]" value="<?= (isset($designs['ul li a.logout_button:hover']['color']['value'])) ? $designs['ul li a.logout_button:hover']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[ul li a.logout_button:hover][color][id]" value="<?= (isset($designs['ul li a.logout_button:hover']['color']['id'])) ? $designs['ul li a.logout_button:hover']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h2><?= FOLDER ?></h2>

		<h3><?= FOLDER_SECTION_LINE ?></h3>

		<label for="design_mediastorage[span.category_title_folder][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_folder][background-color][value]" id="design_mediastorage[span.category_title_folder][background-color][value]" value="<?= (isset($designs['span.category_title_folder']['background-color']['value'])) ? $designs['span.category_title_folder']['background-color']['value'] : '#bfbfbf' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_folder][background-color][value]"  value="<?= (isset($designs['span.category_title_folder']['background-color']['value'])) ? $designs['span.category_title_folder']['background-color']['value'] : '#bfbfbf' ?>"><br />
		<input type="hidden" name="design_mediastorage[span.category_title_folder][background-color][id]" value="<?= (isset($designs['span.category_title_folder']['background-color']['id'])) ? $designs['span.category_title_folder']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[span.category_title_folder][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_folder][color][value]" id="design_mediastorage[span.category_title_folder][color][value]" value="<?= (isset($designs['span.category_title_folder']['color']['value'])) ? $designs['span.category_title_folder']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_folder][color][value]" id="design_mediastorage[span.category_title_folder][color][value]" value="<?= (isset($designs['span.category_title_folder']['color']['value'])) ? $designs['span.category_title_folder']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[span.category_title_folder][color][id]" value="<?= (isset($designs['span.category_title_folder']['color']['id'])) ? $designs['span.category_title_folder']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= FOLDER_TITLE_BLOCK ?></h3>

		<label for="design_mediastorage[div.folder_title_div][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.folder_title_div][background-color][value]" id="design_mediastorage[div.folder_title_div][background-color][value]" value="<?= (isset($designs['div.folder_title_div']['background-color']['value'])) ? $designs['div.folder_title_div']['background-color']['value'] : '#e9e9e9' ?>" />
		<input type="text" name="design_mediastorage[div.folder_title_div][background-color][value]"  value="<?= (isset($designs['div.folder_title_div']['background-color']['value'])) ? $designs['div.folder_title_div']['background-color']['value'] : '#e9e9e9' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.folder_title_div][background-color][id]" value="<?= (isset($designs['div.folder_title_div']['background-color']['id'])) ? $designs['div.folder_title_div']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.folder_title_div][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.folder_title_div][color][value]" id="design_mediastorage[div.folder_title_div][color][value]" value="<?= (isset($designs['div.folder_title_div']['color']['value'])) ? $designs['div.folder_title_div']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.folder_title_div][color][value]" id="design_mediastorage[div.folder_title_div][color][value]" value="<?= (isset($designs['div.folder_title_div']['color']['value'])) ? $designs['div.folder_title_div']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.folder_title_div][color][id]" value="<?= (isset($designs['div.folder_title_div']['color']['id'])) ? $designs['div.folder_title_div']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= FOLDER_DESCRIPTION_BLOCK ?></h3>

		<label for="design_mediastorage[div.folder][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.folder][background-color][value]" id="design_mediastorage[div.folder][background-color][value]" value="<?= (isset($designs['div.folder']['background-color']['value'])) ? $designs['div.folder']['background-color']['value'] : '#FFFFCC' ?>" />
		<input type="text" name="design_mediastorage[div.folder][background-color][value]"  value="<?= (isset($designs['div.folder']['background-color']['value'])) ? $designs['div.folder']['background-color']['value'] : '#FFFFCC' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.folder][background-color][id]" value="<?= (isset($designs['div.folder']['background-color']['id'])) ? $designs['div.folder']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.folder_description][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.folder_description][color][value]" id="design_mediastorage[div.folder_description][color][value]" value="<?= (isset($designs['div.folder_description']['color']['value'])) ? $designs['div.folder_description']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.folder_description][color][value]" id="design_mediastorage[div.folder_description][color][value]" value="<?= (isset($designs['div.folder_description']['color']['value'])) ? $designs['div.folder_description']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.folder_description][color][id]" value="<?= (isset($designs['div.folder_description']['color']['id'])) ? $designs['div.folder_description']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h2><?= PROGRAM ?></h2>

		<h3><?= PROGRAM_SECTION_LINE ?></h3>

		<label for="design_mediastorage[span.category_title_program][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_program][background-color][value]" id="design_mediastorage[span.category_title_program][background-color][value]" value="<?= (isset($designs['span.category_title_program']['background-color']['value'])) ? $designs['span.category_title_program']['background-color']['value'] : '#bfbfbf' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_program][background-color][value]"  value="<?= (isset($designs['span.category_title_program']['background-color']['value'])) ? $designs['span.category_title_program']['background-color']['value'] : '#bfbfbf' ?>"><br />
		<input type="hidden" name="design_mediastorage[span.category_title_program][background-color][id]" value="<?= (isset($designs['span.category_title_program']['background-color']['id'])) ? $designs['span.category_title_program']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[span.category_title_program][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_program][color][value]" id="design_mediastorage[span.category_title_program][color][value]" value="<?= (isset($designs['span.category_title_program']['color']['value'])) ? $designs['span.category_title_program']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_program][color][value]" id="design_mediastorage[span.category_title_program][color][value]" value="<?= (isset($designs['span.category_title_program']['color']['value'])) ? $designs['span.category_title_program']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[span.category_title_program][color][id]" value="<?= (isset($designs['span.category_title_program']['color']['id'])) ? $designs['span.category_title_program']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= PROGRAM_TITLE_BLOCK ?></h3>

		<label for="design_mediastorage[div.program_title_div][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.program_title_div][background-color][value]" id="design_mediastorage[div.program_title_div][background-color][value]" value="<?= (isset($designs['div.program_title_div']['background-color']['value'])) ? $designs['div.program_title_div']['background-color']['value'] : '#e9e9e9' ?>" />
		<input type="text" name="design_mediastorage[div.program_title_div][background-color][value]"  value="<?= (isset($designs['div.program_title_div']['background-color']['value'])) ? $designs['div.program_title_div']['background-color']['value'] : '#e9e9e9' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.program_title_div][background-color][id]" value="<?= (isset($designs['div.program_title_div']['background-color']['id'])) ? $designs['div.program_title_div']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.program_title_div][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.program_title_div][color][value]" id="design_mediastorage[div.program_title_div][color][value]" value="<?= (isset($designs['div.program_title_div']['color']['value'])) ? $designs['div.program_title_div']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.program_title_div][color][value]" id="design_mediastorage[div.program_title_div][color][value]" value="<?= (isset($designs['div.program_title_div']['color']['value'])) ? $designs['div.program_title_div']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.program_title_div][color][id]" value="<?= (isset($designs['div.program_title_div']['color']['id'])) ? $designs['div.program_title_div']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= PROGRAM_DESCRIPTION_BLOCK ?></h3>

		<label for="design_mediastorage[div.program][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.program][background-color][value]" id="design_mediastorage[div.program][background-color][value]" value="<?= (isset($designs['div.program']['background-color']['value'])) ? $designs['div.program']['background-color']['value'] : '#FFFFCC' ?>" />
		<input type="text" name="design_mediastorage[div.program][background-color][value]"  value="<?= (isset($designs['div.program']['background-color']['value'])) ? $designs['div.program']['background-color']['value'] : '#FFFFCC' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.program][background-color][id]" value="<?= (isset($designs['div.program']['background-color']['id'])) ? $designs['div.program']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.program_description][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.program_description][color][value]" id="design_mediastorage[div.program_description][color][value]" value="<?= (isset($designs['div.program_description']['color']['value'])) ? $designs['div.program_description']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.program_description][color][value]" id="design_mediastorage[div.program_description][color][value]" value="<?= (isset($designs['div.program_description']['color']['value'])) ? $designs['div.program_description']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.program_description][color][id]" value="<?= (isset($designs['div.program_description']['color']['id'])) ? $designs['div.program_description']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h2><?= CONTENT ?></h2>

		<h3><?= CONTENT_SECTION_LINE ?></h3>

		<label for="design_mediastorage[span.category_title_content][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_content][background-color][value]" id="design_mediastorage[span.category_title_content][background-color][value]" value="<?= (isset($designs['span.category_title_content']['background-color']['value'])) ? $designs['span.category_title_content']['background-color']['value'] : '#bfbfbf' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_content][background-color][value]"  value="<?= (isset($designs['span.category_title_content']['background-color']['value'])) ? $designs['span.category_title_content']['background-color']['value'] : '#bfbfbf' ?>"><br />
		<input type="hidden" name="design_mediastorage[span.category_title_content][background-color][id]" value="<?= (isset($designs['span.category_title_content']['background-color']['id'])) ? $designs['span.category_title_content']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[span.category_title_content][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[span.category_title_content][color][value]" id="design_mediastorage[span.category_title_content][color][value]" value="<?= (isset($designs['span.category_title_content']['color']['value'])) ? $designs['span.category_title_content']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[span.category_title_content][color][value]" id="design_mediastorage[span.category_title_content][color][value]" value="<?= (isset($designs['span.category_title_content']['color']['value'])) ? $designs['span.category_title_content']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[span.category_title_content][color][id]" value="<?= (isset($designs['span.category_title_content']['color']['id'])) ? $designs['span.category_title_content']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= CONTENT_TITLE_BLOCK ?></h3>

		<label for="design_mediastorage[div.content_title_div][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.content_title_div][background-color][value]" id="design_mediastorage[div.content_title_div][background-color][value]" value="<?= (isset($designs['div.content_title_div']['background-color']['value'])) ? $designs['div.content_title_div']['background-color']['value'] : '#e9e9e9' ?>" />
		<input type="text" name="design_mediastorage[div.content_title_div][background-color][value]"  value="<?= (isset($designs['div.content_title_div']['background-color']['value'])) ? $designs['div.content_title_div']['background-color']['value'] : '#e9e9e9' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.content_title_div][background-color][id]" value="<?= (isset($designs['div.content_title_div']['background-color']['id'])) ? $designs['div.content_title_div']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.content_title_div][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.content_title_div][color][value]" id="design_mediastorage[div.content_title_div][color][value]" value="<?= (isset($designs['div.content_title_div']['color']['value'])) ? $designs['div.content_title_div']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.content_title_div][color][value]" id="design_mediastorage[div.content_title_div][color][value]" value="<?= (isset($designs['div.content_title_div']['color']['value'])) ? $designs['div.content_title_div']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.content_title_div][color][id]" value="<?= (isset($designs['div.content_title_div']['color']['id'])) ? $designs['div.content_title_div']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= CONTENT_DESCRIPTION_BLOCK ?></h3>

		<label for="design_mediastorage[div.content][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.content][background-color][value]" id="design_mediastorage[div.content][background-color][value]" value="<?= (isset($designs['div.content']['background-color']['value'])) ? $designs['div.content']['background-color']['value'] : '#FFFFCC' ?>" />
		<input type="text" name="design_mediastorage[div.content][background-color][value]"  value="<?= (isset($designs['div.content']['background-color']['value'])) ? $designs['div.content']['background-color']['value'] : '#FFFFCC' ?>"><br />
		<input type="hidden" name="design_mediastorage[div.content][background-color][id]" value="<?= (isset($designs['div.content']['background-color']['id'])) ? $designs['div.content']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[div.content_description][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[div.content_description][color][value]" id="design_mediastorage[div.content_description][color][value]" value="<?= (isset($designs['div.content_description']['color']['value'])) ? $designs['div.content_description']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[div.content_description][color][value]" id="design_mediastorage[div.content_description][color][value]" value="<?= (isset($designs['div.content_description']['color']['value'])) ? $designs['div.content_description']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[div.content_description][color][id]" value="<?= (isset($designs['div.content_description']['color']['id'])) ? $designs['div.content_description']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h2><?= CONTENT_PAGE ?></h2>

		<h3><?= CONTENT_DESCRIPTION_BLOCK ?></h3>

		<label for="design_mediastorage[#description_div][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#description_div][background-color][value]" id="design_mediastorage[#description_div][background-color][value]" value="<?= (isset($designs['#description_div']['background-color']['value'])) ? $designs['#description_div']['background-color']['value'] : '#f2f2f2' ?>" />
		<input type="text" name="design_mediastorage[#description_div][background-color][value]"  value="<?= (isset($designs['#description_div']['background-color']['value'])) ? $designs['#description_div']['background-color']['value'] : '#f2f2f2' ?>"><br />
		<input type="hidden" name="design_mediastorage[#description_div][background-color][id]" value="<?= (isset($designs['#description_div']['background-color']['id'])) ? $designs['#description_div']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#description_div][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#description_div][color][value]" id="design_mediastorage[#description_div][color][value]" value="<?= (isset($designs['#description_div']['color']['value'])) ? $designs['#description_div']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[#description_div][color][value]" id="design_mediastorage[#description_div][color][value]" value="<?= (isset($designs['#description_div']['color']['value'])) ? $designs['#description_div']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#description_div][color][id]" value="<?= (isset($designs['#description_div']['color']['id'])) ? $designs['#description_div']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#description_div][border-color][value]"><?= CSS_BORDER_COLOR ?> : </label>
		<input type="border-color" name="design_mediastorage[#description_div][border-color][value]" id="design_mediastorage[#description_div][border-color][value]" value="<?= (isset($designs['#description_div']['border-color']['value'])) ? $designs['#description_div']['border-color']['value'] : '#d5d5d5' ?>" />
		<input type="text" name="design_mediastorage[#description_div][border-color][value]" id="design_mediastorage[#description_div][border-color][value]" value="<?= (isset($designs['#description_div']['border-color']['value'])) ? $designs['#description_div']['border-color']['value'] : '#d5d5d5' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#description_div][border-color][id]" value="<?= (isset($designs['#description_div']['border-color']['id'])) ? $designs['#description_div']['border-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= CONTENT_ACTION_BLOCK ?></h3>

		<label for="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][background-color][value]" id="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][background-color][value]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['value'] : '#f2f2f2' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][background-color][value]"  value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['value'] : '#f2f2f2' ?>"><br />
		<input type="hidden" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][background-color][id]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['id'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][value]" id="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][value]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][value]" id="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][value]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][color][id]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['id'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][value]"><?= CSS_BORDER_COLOR ?> : </label>
		<input type="border-color" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][value]" id="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][value]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['value'] : '#d5d5d5' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][value]" id="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][value]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['value'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['value'] : '#d5d5d5' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table, #download_link_table th, #download_link_table td][border-color][id]" value="<?= (isset($designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['id'])) ? $designs['#download_link_table, #download_link_table th, #download_link_table td']['border-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table th][background-color][value]"><?= CSS_HEADER_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table th][background-color][value]" id="design_mediastorage[#download_link_table th][background-color][value]" value="<?= (isset($designs['#download_link_table th']['background-color']['value'])) ? $designs['#download_link_table th']['background-color']['value'] : '#d5d5d5' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table th][background-color][value]"  value="<?= (isset($designs['#download_link_table th']['background-color']['value'])) ? $designs['#download_link_table th']['background-color']['value'] : '#d5d5d5' ?>"><br />
		<input type="hidden" name="design_mediastorage[#download_link_table th][background-color][id]" value="<?= (isset($designs['#download_link_table th']['background-color']['id'])) ? $designs['#download_link_table th']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table th][color][value]"><?= CSS_HEADER_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table th][color][value]" id="design_mediastorage[#download_link_table th][color][value]" value="<?= (isset($designs['#download_link_table th']['color']['value'])) ? $designs['#download_link_table th']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table th][color][value]" id="design_mediastorage[#download_link_table th][color][value]" value="<?= (isset($designs['#download_link_table th']['color']['value'])) ? $designs['#download_link_table th']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table th][color][id]" value="<?= (isset($designs['#download_link_table th']['color']['id'])) ? $designs['#download_link_table th']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= CONTENT_ACTION_BUTTON ?></h3>

		<label for="design_mediastorage[#download_link_table a][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table a][background-color][value]" id="design_mediastorage[#download_link_table a][background-color][value]" value="<?= (isset($designs['#download_link_table a']['background-color']['value'])) ? $designs['#download_link_table a']['background-color']['value'] : '#f2f2f2' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table a][background-color][value]" id="design_mediastorage[#download_link_table a][background-color][value]" value="<?= (isset($designs['#download_link_table a']['background-color']['value'])) ? $designs['#download_link_table a']['background-color']['value'] : '#f2f2f2' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table a][background-color][id]" value="<?= (isset($designs['#download_link_table a']['background-color']['id'])) ? $designs['#download_link_table a']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table a][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table a][color][value]" id="design_mediastorage[#download_link_table a][color][value]" value="<?= (isset($designs['#download_link_table a']['color']['value'])) ? $designs['#download_link_table a']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table a][color][value]" id="design_mediastorage[#download_link_table a][color][value]" value="<?= (isset($designs['#download_link_table a']['color']['value'])) ? $designs['#download_link_table a']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table a][color][id]" value="<?= (isset($designs['#download_link_table a']['color']['id'])) ? $designs['#download_link_table a']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table a:hover][background-color][value]"><?= CSS_BACKGROUND_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table a:hover][background-color][value]" id="design_mediastorage[#download_link_table a:hover][background-color][value]" value="<?= (isset($designs['#download_link_table a:hover']['background-color']['value'])) ? $designs['#download_link_table a:hover']['background-color']['value'] : '#a1a1a1' ?>" /><
		<input type="text" name="design_mediastorage[#download_link_table a:hover][background-color][value]" id="design_mediastorage[#download_link_table a:hover][background-color][value]" value="<?= (isset($designs['#download_link_table a:hover']['background-color']['value'])) ? $designs['#download_link_table a:hover']['background-color']['value'] : '#a1a1a1' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table a:hover][background-color][id]" value="<?= (isset($designs['#download_link_table a:hover']['background-color']['id'])) ? $designs['#download_link_table a:hover']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[#download_link_table a:hover][color][value]"><?= CSS_COLOR_HOVER ?> : </label>
		<input type="color" name="design_mediastorage[#download_link_table a:hover][color][value]" id="design_mediastorage[#download_link_table a:hover][color][value]" value="<?= (isset($designs['#download_link_table a:hover']['color']['value'])) ? $designs['#download_link_table a:hover']['color']['value'] : '#ffffff' ?>" />
		<input type="text" name="design_mediastorage[#download_link_table a:hover][color][value]" id="design_mediastorage[#download_link_table a:hover][color][value]" value="<?= (isset($designs['#download_link_table a:hover']['color']['value'])) ? $designs['#download_link_table a:hover']['color']['value'] : '#ffffff' ?>" /><br />
		<input type="hidden" name="design_mediastorage[#download_link_table a:hover][color][id]" value="<?= (isset($designs['#download_link_table a:hover']['color']['id'])) ? $designs['#download_link_table a:hover']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<h3><?= FILE_BLOCK ?></h3>

		<label for="design_mediastorage[.video_content][background-color][value]"><?= CSS_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.video_content][background-color][value]" id="design_mediastorage[.video_content][background-color][value]" value="<?= (isset($designs['.video_content']['background-color']['value'])) ? $designs['.video_content']['background-color']['value'] : '#d5d5d5' ?>" />
		<input type="text" name="design_mediastorage[.video_content][background-color][value]"  value="<?= (isset($designs['.video_content']['background-color']['value'])) ? $designs['.video_content']['background-color']['value'] : '#d5d5d5' ?>"><br />
		<input type="hidden" name="design_mediastorage[.video_content][background-color][id]" value="<?= (isset($designs['.video_content']['background-color']['id'])) ? $designs['.video_content']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.video_content][color][value]"><?= CSS_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.video_content][color][value]" id="design_mediastorage[.video_content][color][value]" value="<?= (isset($designs['.video_content']['color']['value'])) ? $designs['.video_content']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[.video_content][color][value]" id="design_mediastorage[.video_content][color][value]" value="<?= (isset($designs['.video_content']['color']['value'])) ? $designs['.video_content']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.video_content][color][id]" value="<?= (isset($designs['.video_content']['color']['id'])) ? $designs['.video_content']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.content_thumbnail_header][background-color][value]"><?= CSS_HEADER_BACKGROUND_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.content_thumbnail_header][background-color][value]" id="design_mediastorage[.content_thumbnail_header][background-color][value]" value="<?= (isset($designs['.content_thumbnail_header']['background-color']['value'])) ? $designs['.content_thumbnail_header']['background-color']['value'] : '#e4e4e4' ?>" />
		<input type="text" name="design_mediastorage[.content_thumbnail_header][background-color][value]"  value="<?= (isset($designs['.content_thumbnail_header']['background-color']['value'])) ? $designs['.content_thumbnail_header']['background-color']['value'] : '#e4e4e4' ?>"><br />
		<input type="hidden" name="design_mediastorage[.content_thumbnail_header][background-color][id]" value="<?= (isset($designs['.content_thumbnail_header']['background-color']['id'])) ? $designs['.content_thumbnail_header']['background-color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<label for="design_mediastorage[.content_thumbnail_header][color][value]"><?= CSS_HEADER_COLOR ?> : </label>
		<input type="color" name="design_mediastorage[.content_thumbnail_header][color][value]" id="design_mediastorage[.content_thumbnail_header][color][value]" value="<?= (isset($designs['.content_thumbnail_header']['color']['value'])) ? $designs['.content_thumbnail_header']['color']['value'] : '#000000' ?>" />
		<input type="text" name="design_mediastorage[.content_thumbnail_header][color][value]" id="design_mediastorage[.content_thumbnail_header][color][value]" value="<?= (isset($designs['.content_thumbnail_header']['color']['value'])) ? $designs['.content_thumbnail_header']['color']['value'] : '#000000' ?>" /><br />
		<input type="hidden" name="design_mediastorage[.content_thumbnail_header][color][id]" value="<?= (isset($designs['.content_thumbnail_header']['color']['id'])) ? $designs['.content_thumbnail_header']['color']['id'] : 0 ?>"/>
		<div class="clear"></div>

		<input type="hidden" name="design_create_mediastorage" value="87463975" />
		<a id="cancel_button" class="form_button" href="?page=list_group_root"><?= CANCEL ?></a>
		<a id="validate_button" class="form_button" href="#" onclick="document.getElementById('form').submit(); return false;"><?= VALIDATE ?></a>

	</form>

</div>

<?php

require_once('RootBundle/views/layout/footer.php');

?>
