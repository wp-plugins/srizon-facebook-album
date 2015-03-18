<?php
function srz_fb_albums() {
	SrizonFBUI::PageWrapStart();
	if (isset($_REQUEST['srzf'])) {
		switch ($_REQUEST['srzf']) {
			case 'edit':
				srz_fb_albums_edit();
				break;
			case 'save';
				srz_fb_albums_save();
				break;
			case 'delete':
				srz_fb_albums_delete();
				break;
			case 'sync':
				srz_fb_albums_sync();
				break;
			default:
				break;
		}
	} else {
		echo '<h2>Albums<a href="admin.php?page=SrzFb-Albums&srzf=edit" class="add-new-h2">Add New</a></h2>';
		$albums = SrizonFBDB::GetAllAlbums();
		include('album-table.php');
	}
	SrizonFBUI::PageWrapEnd();
}


function srz_fb_albums_edit() {
	if (isset($_GET['id'])) {
		echo '<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div><h2>Edit Album</h2>';
		$value_arr = SrizonFBDB::GetAlbum($_GET['id']);
		if(!isset($value_arr['image_sorting'])) $value_arr['image_sorting']='default';
	} else {
		echo '<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div><h2>Add New Album</h2>';
		$value_arr = array(
			'title' => '',
			'albumid' => '',
			'updatefeed' => '600',
			'image_sorting' => 'default',
			'totalimg' => '25',
			'layout' => 'collage_thumb',
			'tpltheme' => 'white',
			'paginatenum' => '18',
			'targetheight' => '200',
			'collagepadding' => '2',
			'collagepartiallast' =>  'false',
			'hovercaption' =>  '1',
			'hovercaptiontype' =>  '0',
			'showhoverzoom' =>  '1',
			'animationspeed' =>  '500',
			'maxheight' =>  '500',
			'app_id' => '',
			'app_secret' => '',
		);
	}
	SrizonFBUI::OptionWrapperStart();
	SrizonFBUI::RightColStart();
	SrizonFBUI::BoxHeader('box1', "About Single Album");
	echo '<div><div class="misc-pub-section">As the name suggests, It\'s a single Facebook fanpage album.</div><div class="misc-pub-section">You need to put the ID (or IDs) of the fanpage album(s). If multiple IDs are used, they will be merged into a single album.</div></div>';
	SrizonFBUI::BoxFooter();
	SrizonFBUI::RightColEnd();
	SrizonFBUI::LeftColStart();
	include 'album-option-form.php';
	SrizonFBUI::LeftColEnd();
	SrizonFBUI::OptionWrapperEnd();
}

function srz_fb_albums_save() {
	if (wp_verify_nonce($_POST['srjfb_submit'], 'srz_fb_albums') == false) die('Nice Try!');
	if (!isset($_POST['id'])) {
		SrizonFBDB::SaveAlbum(true);
		echo '<h2>New Album Created</h2>';
	} else {
		SrizonFBDB::SaveAlbum(false);
		echo '<h2>Album Updated</h2>';
	}
	echo '<a href="admin.php?page=SrzFb-Albums">Go Back to Albums</a>';
}

function srz_fb_albums_delete() {
	if (isset($_GET['id'])) {
		SrizonFBDB::DeleteAlbum($_GET['id']);
	}
	echo '<h2>Album deleted</h2>';
	echo '<a href="admin.php?page=SrzFb-Albums">Go Back to Albums</a>';
}

function srz_fb_albums_sync() {
	if (isset($_GET['id'])) {
		SrizonFBDB::SyncAlbum($_GET['id']);
	}
	echo '<h2>Cached Data Deleted! Album will be synced on next load.</h2>';
	echo '<a href="admin.php?page=SrzFb-Albums">Go Back to Albums</a>';
}