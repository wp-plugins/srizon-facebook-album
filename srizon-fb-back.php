<?php
add_action( 'admin_menu', 'srz_fb_menu' );

function srz_fb_menu() {
	add_menu_page('FB Album', "FB Album", 'manage_options', 'SrzFb', 'srz_fb_options_page', srz_fb_get_resource_url('images/srzfb-icon.png'));
	add_submenu_page('SrzFb', "FB Album", "Albums", 'manage_options', 'SrzFb-Albums', 'srz_fb_albums');
	add_submenu_page('SrzFb', "FB Album", "Galleries", 'manage_options', 'SrzFb-Galleries', 'srz_fb_galleries');
}

function srz_fb_options_page() {
	SrizonFBUI::PageWrapStart();
	if ($_POST['submit']) {
		if (wp_verify_nonce($_POST['srjfb_submit'], 'SrjFb') == false) die('Form token mismatch!');
		$optvar = SrizonFBDB::SaveCommonOpt();
	} else {
		$optvar = SrizonFBDB::GetCommonOpt();
	}
	echo '<div class="icon32" id="icon-tools"><br /></div><h2>Srizon FB Album Option Page</h2>';
	SrizonFBUI::OptionWrapperStart();
	SrizonFBUI::RightColStart();
	SrizonFBUI::BoxHeader('box1', "About This Plugin");
	echo '<p>This Plugin will show your Facebook fanpage album(s) into your wordpress site. Select "Albums" or "Galleries" from submenu and add a new album or gallery. Use the generated shortcode on your post/page to display the album/gallery</p>';
	SrizonFBUI::BoxFooter();
	SrizonFBUI::RightColEnd();
	SrizonFBUI::LeftColStart();
	include 'common-option-form.php';
	SrizonFBUI::LeftColEnd();
	SrizonFBUI::OptionWrapperEnd();
	SrizonFBUI::PageWrapEnd();
}