<style>

li a {
	text-decoration: none;
	color: rgba(200, 200, 200, 0.9);
	padding-left: 5%;
	display: inline-block;

	height: 40px;
	line-height: 40px;
	width: 100%;

}

li a:hover {
	background-color: #FED500;
	color: black;
}

li {
	display: inline-block;
	width: 100%;
	vertical-align: middle;
}

ul {
	list-style-type: none;
	padding: 0px;
	margin: 0px;
	font-family: "Quicksand";
	font-weight: bold;
}

.profile_button {
	width:49%; float: left; text-align: center; padding: 0;background-color:  #404040;
	border-right: 1px solid #262626;
	color: white;
}

.profile_button:hover {
	background-color:  #0099ff;
	color: white;
}

.logout_button {
	width:49%; float: right;text-align: center; padding:0;background-color: #404040;
	color: white;
}

.logout_button:hover {
	background-color: #b30000;
	color: white;
}

</style>

<div off-canvas="slidebar-1 left reveal">
	<ul>
		<li><div><img style="max-width: 245px; max-height: 150px; display:table-cell; margin: 20px auto 20px auto; border: 1px solid rgba(0, 0, 0, 0.7);display: block;" src="https://pbs.twimg.com/profile_images/1179925665/media365_400.jpg" ></div></li>
		<li><a class="logout_button" href="?page=logout"><?= LOGOUT ?></a><a class="profile_button" href="#">Profile</a></li>
		<li><a href="?page=create_user"><?= USER_CREATION_TITLE ?></a></li>
		<li><a href="?page=list_user"><?= USER_LIST_TITLE ?></a></li>
		<li><a href="?page=list_role"><?= ROLE_LIST_TITLE ?></a></li>
		<li><a href="?page=create_role"><?= ROLE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_role_language"><?= ROLE_LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_role_permit"><?= ROLE_PERMIT_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_sharelist"><?= SHARELIST_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_sharelist_media"><?= SHARELIST_MEDIA_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_organization"><?= ORGANIZATION_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_group"><?= GROUP_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_group_language"><?= GROUP_LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_language"><?= LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_tag"><?= TAG_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_tag_language"><?= TAG_LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_cart"><?= CART_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_chapter"><?= CHAPTER_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_chapter_language"><?= CHAPTER_LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_maillist"><?= MAILLIST_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_folder"><?= FOLDER_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_folder_language"><?= FOLDER_LANGUAGE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_folder_media"><?= FOLDER_MEDIA_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_info"><?= MEDIA_INFO_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media"><?= MEDIA_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_info_extra_field"><?= MEDIA_INFO_EXTRA_FIELD_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_info_extra_array"><?= MEDIA_INFO_EXTRA_ARRAY_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_info_extra"><?= MEDIA_INFO_EXTRA_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_type"><?= MEDIA_TYPE_CREATION_TITLE ?></a></li>
		<li><a href="?page=create_media_type_field"><?= MEDIA_TYPE_FIELD_CREATION_TITLE ?></a></li>
	</ul>
</div>