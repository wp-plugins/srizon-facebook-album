<?php
function srz_fb_galleries() {
	SrizonFBUI::PageWrapStart();
	if ( isset( $_REQUEST['srzf'] ) ) {
		switch ( $_REQUEST['srzf'] ) {
			case 'edit':
				srz_fb_galleries_edit();
				break;
			case 'save':
				srz_fb_galleries_save();
				break;
			case 'delete':
				srz_fb_galleries_delete();
				break;
			case 'sync':
				srz_fb_galleries_sync();
				break;
			default:
				break;
		}
	} else {
		echo '<h2>Galleries<a href="admin.php?page=SrzFb-Galleries&srzf=edit" class="add-new-h2">Add New</a></h2>';
		$galleries = SrizonFBDB::GetAllGalleries();
		include( 'gallery-table.php' );
	}
	SrizonFBUI::PageWrapEnd();
}

function srz_fb_galleries_edit() {
	if ( isset( $_REQUEST['id'] ) ) {
		echo '<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div><h2>Edit Gallery</h2>';
		$value_arr = SrizonFBDB::GetGallery( $_GET['id'] );
		if ( ! isset( $value_arr['image_sorting'] ) ) {
			$value_arr['image_sorting'] = 'default';
		}
		if ( ! isset( $value_arr['album_sorting'] ) ) {
			$value_arr['album_sorting'] = 'default';
		}
	} else {
		echo '<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div><h2>Add New Gallery</h2>';
		$value_arr = array(
			'title'              => '',
			'pageid'             => '',
			'excludeids'         => '',
			'include_exclude'    => 'exclude',
			'updatefeed'         => '600',
			'image_sorting'      => 'default',
			'album_sorting'      => 'default',
			'liststyle'          => 'slidergridv',
			'totalimg'           => '25',
			'paginatenum'        => '18',
			'collagepadding'     => '2',
			'collagepartiallast' => '0',
			'hovercaption'       => '1',
			'hovercaptiontype'   => '0',
			'show_image_count'   => '1',
			'showhoverzoom'      => '1',
			'maxheight'          => '250',
			'app_id'             => '',
			'app_secret'         => '',
		);
	}
	SrizonFBUI::OptionWrapperStart();
	SrizonFBUI::RightColStart();
	SrizonFBUI::BoxHeader( 'box1', "About Gallery" );
	echo '<div><div class="misc-pub-section">Gallery is a 2 level view of your Facebook fanpage albums</div><div class="misc-pub-section">It just takes the page ID and gets all the albums from the page</div><div class="misc-pub-section">You can exclude/remove some albums by using their album IDs on the exclusion list</div><div class="misc-pub-section">First level shows the album covers. Clicking on the cover of an album will take you to the second level listing the thumbs of that album</div></div>';
	SrizonFBUI::BoxFooter();
	SrizonFBUI::RightColEnd();
	SrizonFBUI::LeftColStart();
	include 'gallery-option-form.php';
	SrizonFBUI::LeftColEnd();
	SrizonFBUI::OptionWrapperEnd();
}

function srz_fb_galleries_save() {
	if ( wp_verify_nonce( $_POST['srjfb_submit'], 'SrzFbGalleries' ) == false ) {
		die( 'Nice Try!' );
	}
	if ( ! isset( $_POST['id'] ) ) {
		SrizonFBDB::SaveGallery( true );
		echo '<h2>New Gallery Created</h2>';
	} else {
		SrizonFBDB::SaveGallery( false );
		echo '<h2>Gallery Updated</h2>';
	}
	echo '<a href="admin.php?page=SrzFb-Galleries">Go Back to Galleries</a>';
}

function srz_fb_galleries_delete() {
	if ( isset( $_GET['id'] ) ) {
		SrizonFBDB::DeleteGallery( $_GET['id'] );
	}
	echo '<h2>Gallery deleted</h2>';
	echo '<a href="admin.php?page=SrzFb-Galleries">Go Back to Galleries</a>';
}

function srz_fb_galleries_sync() {
	if ( isset( $_GET['id'] ) ) {
		SrizonFBDB::SyncGallery( $_GET['id'] );
	}
	echo '<h2>Cached Data Deleted! Gallery and it\'s albums will be synced on next load.</h2>';
	echo '<a href="admin.php?page=SrzFb-Galleries">Go Back to Galleries</a>';
}